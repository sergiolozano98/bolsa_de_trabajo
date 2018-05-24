<?php
namespace UsuariosBundle\Controller;
use UsuariosBundle\Form\UserType;
use UsuariosBundle\Form\UserEmpresaType;
use UsuariosBundle\Entity\User;
use EmpresasBundle\Entity\Empresa;
use EmpresasBundle\Form\EmpresaType;
use OfertasBundle\Entity\Oferta;
use OfertasBundle\From\OfertaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UsuarioController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // Registrar usuario candidato
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //Usuario inserta empresa en Null
            $user->setRoles(["ROLE_CANDIDATO"]);
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // si el login es correcto se va al login
            return $this->redirectToRoute('login');
        }
        return $this->render(
            'UsuariosBundle:Default:register.html.twig',
            array('form' => $form->createView(),
          )
        );
    }

    /**
     * @Route("/NuevoUsuario/{empresa}", name="NuevoUsuario")
     */
    public function NuevoUsuarioEmpresaAction(Request $request, $empresa)
    {
        // Registrar usuario de empresa
        $user = new User();
        $Roles2=["ROLE_PRUEBA"];
        $NombreEmpresa=$this -> DameNombreEmpresa($empresa);
        $form = $this->createForm(UserEmpresaType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
          $empresa =  $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')
                    ->find($empresa);
            $user->setEmpresa($empresa);


            $user->setRoles($roles);
            // 4) save the User!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();
             $paso = 'Guardado';
        }
        // selecionar si el nuevo usuario lo crea el Admin o un editor
        $userActual = $this->get('security.token_storage')->getToken()->getUser();
        if ($userActual->getRoles() == ['ROLE_ADMIN'] || $userActual->getRoles() == ['ROLE_EDITOR']) {
            return $this->render(
                'UsuariosBundle:Default:muestra.html.twig',
                array('form'    => $form->createView(),
                    'empresa'   => $NombreEmpresa,
                    'NEmpresa'  => $empresa,
                    'error'     => $error,
                    'paso'      => $paso
              )
            );
        } else {
            return $this->AccionNoPermitida();
        }
    }

    /**
    * @Route("/login", name="login")
    */
    public function loginAction(Request $request)
    {
      $authenticationUtils = $this->get('security.authentication_utils');
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();
      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();
      //recoge todos los datos del user
      $user = $this->get('security.token_storage')->getToken()->getUser();
      // Selecciona por tipo de usuario
      if($user != 'anon.'){
        if ($user->getRoles() == ['ROLE_ADMIN']) {
            return $this -> MuestraInicioAdmin($user);
        }
        if ($user->getRoles() == ['ROLE_CANDIDATO']) {
            // Candidato, sólo puede suscribirse a las ofertas
          echo "candidato";
        }
        if ($user->getRoles() == ['ROLE_EDITOR'] || $user->getRoles() == ['ROLE_EMPRESA']) {
            // Usuario de tipo empresa CON permiso para crear ofertas
            return $this -> MuestraInicioEmpresa($user);
        }
      }
      $Ofertas = $this->DameOfertas();
      // Opción NO LOGEADO
      return $this->render('UsuariosBundle:Default:index.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'Tipo'          => $lastUsername,
            'ofertas'       => $Ofertas,
            'cadena'      => 'Ofertas'
          ));
    }

    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction()
    {
      return $this->render('UsuarioBundle:Default:index.html.twig');
    }

     /**
     * Busca y muestra una oferta
     *
     * @Route("/muestra", name="show")
     */
    public function showAction(Oferta $oferta)
    {
        $deleteForm = $this->createDeleteForm($oferta);
        return $this->render('UsuaarioBundle:Default:show.html.twig', array(
            'oferta' => $oferta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

     /**
     * Busca y muestra un usuario
     *
     * @Route("/usuario/{id}", name="Muestra_Usuario")
     */
    public function MuestraUsuarioAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $Usuario = $this->getdoctrine()->getRepository('UsuariosBundle:User')->find($id);
        $empresa = $this->DameNumEmpresa($Usuario->getEmpresa());
        $form = $this->createForm(UserType::class, $Usuario);
        // selecionar si el nuevo usuario lo crea el Admin o un editor
        if ($user->getRoles() == ['ROLE_ADMIN'] || $user->getRoles() == ['ROLE_EDITOR']) {
            return $this->render('UsuariosBundle:Default:muestra.html.twig', array(
                'form'      =>$form->createView(),
                'empresa'   => $empresa,
                'usuario'   => $Usuario
            ));
        } else {
             // Para caso de suplantación
            return $this->AccionNoPermitida();
        }
    }





    public function BuscaUsuarios($Id){
        $repository = $this->getdoctrine()->getRepository('UsuariosBundle:User');
        $consulta = $repository->createQueryBuilder('e')
            ->where('e.empresa =:empresa')
            ->setParameter('empresa', $Id)
        ->getQuery();
        $Usuario = $consulta->getResult();
        return $Usuario;
    }

    /**
    * @Route("/empresa", name="empresa")
    */
    public function empresaAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();

        $Empresa=$request->get("empresa");
        if ($Empresa>=1) {
            $empresa =$Empresa;
            $ListadoUsuarios = $this->DameListadoUsuarioEmpresas($empresa);
        } else {
            $empresa =0;
            $ListadoUsuarios =0;
        }

        // Lee el tipo de rol del usuario
        $RolUsuario=$user->getRoles();
        // Busca los datos del usuario registrado
        $usuario = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('email' => $user->getEmail()));
        $listadoEmpresas = $this-> DameListadoEmpresas();
        // Busca las ofertas de la empresa
        $ofertasActivas = $this->DameOfertas();
            return $this->render('UsuariosBundle:Default:inicioAdmin.html.twig',
                array(
                    'nEmpresa'          =>'',
                    'empresa'           =>$empresa,
                    'ListadoEmpresas'   =>$listadoEmpresas,
                    'ListadoUsuarios'   =>$ListadoUsuarios,
                    'usuario'           =>$usuario->getId(),
                    'nombre'            =>$usuario->getNombre(),
                    'ofertasActivas'    =>$ofertasActivas,
                    'NumOfertasActivas' =>count($ofertasActivas),
                    'ofertasBorrador'   => '',
                    'NumOfertasBorrador'=>0,
                    'ofertasCerradas'   => '',
                    'NumOfertasCerradas'=>0,
                    'Rol'               => $RolUsuario[0]
                    ));
    }

    /**
    * @Route("/empresa2", name="empresa2")
    */
    public function empresa2Action(Request $request)
    {
        $Empresa=$request->get("empresa");
        if ($Empresa>=1) {
            $empresa =$Empresa;
            $Empresa = $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')->find($Empresa);
            $ListadoUsuarios = $this->DameListadoUsuarioEmpresas($empresa);
            return $this->forward('EmpresasBundle:Empresas:show',array('empresa' =>$Empresa ));
        } else {
            $empresa =0;
            $ListadoUsuarios =0;
        }
    }
    /**
    * @Route("/empresaAdmin/{empresa}", name="empresaAdmin")
    */
    public function empresaAdminAction(Request $request, $empresa)
    {
        if ($empresa>=1) {
            $Empresa = $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')->find($empresa);
            $ListadoUsuarios = $this->DameListadoUsuarioEmpresas($empresa);
            return $this->forward('EmpresasBundle:Empresas:show',array('empresa' =>$Empresa ));
        } else {
            $empresa =0;
            $ListadoUsuarios =0;
        }
    }



    /* **************************************************
     * Funciones privadas
     * **************************************************
     */


    private function MuestraInicioAdmin($user) {
        // Lee el tipo de rol del usuario
        $RolUsuario=$user->getRoles();
        // Busca los datos del usuario registrado
        $usuario = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('email' => $user->getEmail()));
        $listadoEmpresas = $this-> DameListadoEmpresas();
        // Busca las ofertas de la empresa
        $ofertasActivas = $this->DameOfertas();
            return $this->render('UsuariosBundle:Default:inicioAdmin.html.twig',
                array(
                    'nEmpresa'          =>'',
                    'empresa'           =>'',
                    'ListadoEmpresas'   =>$listadoEmpresas,
                    'usuario'           =>$usuario->getId(),
                    'nombre'            =>$usuario->getNombre(),
                    'ofertasActivas'    =>$ofertasActivas,
                    'NumOfertasActivas' =>count($ofertasActivas),
                    'ofertasBorrador'   => '',
                    'NumOfertasBorrador'=>0,
                    'ofertasCerradas'   => '',
                    'NumOfertasCerradas'=>0,
                    'Rol'               => $RolUsuario[0]
                    ));
    }

    private function MuestraInicioEmpresa($user){
            // Lee el tipo de rol del usuario
            $RolUsuario=$user->getRoles();
            // Busca los datos del usuario registrado
            $usuario = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('email' => $user->getEmail()));
             $form = $this->createForm(UserType::class, $usuario);
            // Busca las ofertas de la empresa

            $ofertasActivas = $this->DameOfertasUsuarioEmpresaPorEstado($usuario->getEmpresa(),1);
            $ofertasBorrador = $this->DameOfertasUsuarioEmpresaPorEstado($usuario->getEmpresa(),2);
            $ofertasCerradas = $this->DameOfertasUsuarioEmpresaPorEstado($usuario->getEmpresa(),3);

            if ($user->getRoles() == ['ROLE_EDITOR']) {
                $ListadoUsuarios = $this->BuscaUsuariosEmpresa($usuario->getEmpresa());
            } else {
                $ListadoUsuarios = '';
            }

            return $this->render('UsuariosBundle:Default:inicioEmpresa.html.twig',
                array('form'            => $form->createView(),
                    'nEmpresa'          => $this->DameNumEmpresa($usuario->getEmpresa()),
                    'empresa'           => $usuario->getEmpresa(),
                    'usuario'           => $usuario->getId(),
                    'nombre'            => $usuario->getNombre(),
                    'ofertasActivas'    => $ofertasActivas,
                    'NumOfertasActivas' =>count($ofertasActivas),
                    'ofertasBorrador'   => $ofertasBorrador,
                    'NumOfertasBorrador'=>count($ofertasBorrador),
                    'ofertasCerradas'   => $ofertasCerradas,
                    'NumOfertasCerradas'=>count($ofertasCerradas),
                    'Rol'               => $RolUsuario[0],
                    'usuarios'          => $ListadoUsuarios
                    ));
    }

    private function DameOfertas(){
       // Listado de ofertas activas
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                    ->where('o.estado  = :estado ')
                    ->setParameter('estado', 1)
                    ->orderBy('o.fecha', 'DESC')
                 ->getQuery();
                $ofertas = $consulta->getResult();
        Return $ofertas;
    }

    public function DameOfertasUsuarioEmpresaPorEstado($empresa,$tipo){
        // Devielve sólo las ofertas de una empresa y según el estado indicado (tipo)
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                    ->where('o.empresa  = :empresa and o.estado  = :estado ')
                    ->setParameter('empresa', $empresa)
                    ->setParameter('estado', $tipo)
                    ->orderBy('o.fecha', 'DESC')
                 ->getQuery();
                $ofertas = $consulta->getResult();
        Return $ofertas;
    }
    private function DameNombreEmpresa($id){
        return $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')
                ->find($id)->getNombre();
    }

    public function DameNumEmpresa($id){
        return  $this->getDoctrine()->getRepository('EmpresasBundle:Empresa')->find($id)->getId();
    }

    private function DameEmpresa($id){
        return $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')
                ->find($id);
    }
    private function DameListadoEmpresas(){
        // Devuelve la lista de las empresas, sólo id y nobre
        $repository = $this->getdoctrine()->getRepository('EmpresasBundle:Empresa');
        $consulta = $repository->createQueryBuilder('e')
            ->select('e.id, e.nombre')
            ->orderBy('e.nombre', 'ASC')
            ->getquery();
        $Listado = $consulta->getResult();

        return $Listado;
    }

    private function DameListadoUsuarioEmpresas($empresa){
        // Devuelve los usuarios asociados a una empresa, sólo id y nombre
        $repository = $this->getdoctrine()->getRepository('UsuariosBundle:User');
        $consulta = $repository->createQueryBuilder('e')
            ->select('e.id, e.nombre')
            ->where('e.empresa  = :empresa ')
            ->setParameter('empresa', $empresa)
            ->orderBy('e.nombre', 'ASC')
            ->getquery();
        $Listado = $consulta->getResult();

        return $Listado;
    }

    public function BuscaUsuariosEmpresa($Id){
        /* Obtiene los usuarios de la empresa los pasa a una matriz*/
        $i=0;
        $repository = $this->getdoctrine()->getRepository('UsuariosBundle:User');

        $consulta = $repository->createQueryBuilder('e')
            ->where('e.empresa =:empresa')
            ->setParameter('empresa', $Id)
        ->getQuery();
        $Usuario = $consulta->getResult();
        $datos = [];
        foreach($Usuario as $u) {
            $datos[$i]['id'] = $u->getid();
            $datos[$i]['nombre'] = $u->getNombre();
            $Roles = $u->getRoles();
            $datos[$i]['rol'] = current($Roles);
            $i++;
        }
        return $datos;
    }

    public function AccionNoPermitida() {
        return $this->render(
            'UsuariosBundle:Default:index.html.twig',
            array( 'last_username' => '',
                'error'         => '',
                'Tipo'          => '',
                'ofertas'       => '',
                'cadena'      => 'Acción no permitida !!!!'
                  )
                );
    }





}
