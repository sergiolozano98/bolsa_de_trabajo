<?php
namespace UsuariosBundle\Controller;
use UsuariosBundle\Form\UserType;
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
            $user->setEmpresa(null);
            $user->setRoles(["ROLE_CANDIDATO"]);
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
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
        $Roles2='wwww';
        $NombreEmpresa=$this -> DameNombreEmpresa($empresa);
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
            $user->setEmpresa($empresa);
            $Roles2 = $user->getRoles();
            // $user->setRoles($roles);
            // 4) save the User!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($user);
            // $entityManager->flush();
        }
        return $this->render(
            'UsuariosBundle:Default:NUsuarioEmpresa.html.twig',
            array('form'    => $form->createView(),
                'empresa'   =>$NombreEmpresa,
                'Roles2'    =>$Roles2
          )
        );
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
        if ($user->getRoles() == ['ROLE_EDITOR']) {
            // Usuario de tipo empresa CON permiso para crear ofertas
            return $this -> MuestraInicioEmpresaEditor($user);
        }
        if ($user->getRoles() == ['ROLE_EMPRESA']) {
            // Usuario de tipo empresa SIN permiso para crear ofertas
            return $this -> MuestraInicioEmpresaUsuario($user);
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
    
    private function MuestraInicioEmpresaEditor($user){
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
            return $this->render('UsuariosBundle:Default:inicioEditor.html.twig',
                array('form'            => $form->createView(),
                    'nEmpresa'          =>$usuario->getEmpresa(),
                    'empresa'           =>$this->DameNombreEmpresa($usuario->getEmpresa()),
                    'usuario'           =>$usuario->getId(),
                    'nombre'            =>$usuario->getNombre(),
                    'ofertasActivas'    => $ofertasActivas,
                    'NumOfertasActivas' =>count($ofertasActivas),
                    'ofertasBorrador'   => $ofertasBorrador,
                    'NumOfertasBorrador'=>count($ofertasBorrador),
                    'ofertasCerradas'   => $ofertasCerradas,
                    'NumOfertasCerradas'=>count($ofertasCerradas),
                    'Rol'               => $RolUsuario[0]
                    ));
    }
    
    private function MuestraInicioEmpresaUsuario($user){
            // Lee el tipo de rol del usuario
            $RolUsuario=$user->getRoles();
            // Busca los datos del usuario registrado
            $usuario = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('email' => $user->getEmail()));
             $form = $this->createForm(UserType::class, $usuario);
            // Busca las ofertas de la empresa
            $ofertasActivas = $this->DameOfertasUsuarioEmpresaPorEstado($usuario->getEmpresa(),1);
            // Falta buscar número de candidatos
            return $this->render('UsuariosBundle:Default:inicioEditor.html.twig',
                array('form'            =>$form->createView(),
                    'nEmpresa'          =>$usuario->getEmpresa(),
                    'empresa'           =>$this->DameNombreEmpresa($usuario->getEmpresa()),
                    'usuario'           =>$usuario->getId(),
                    'nombre'            =>$usuario->getNombre(),
                    'ofertasActivas'    =>$ofertasActivas,
                    'NumOfertas'        =>count($ofertasActivas),
                    'ofertasBorrador'   => '',
                    'NumOfertasBorrador'=>0,
                    'ofertasCerradas'   => '',
                    'NumOfertasCerradas'=>0,
                    'Rol'               => $RolUsuario[0]
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
    
    private function DameNombreEmpresa($id){
        return $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')
                ->find($id)->getNombre();
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
    

    

    

}