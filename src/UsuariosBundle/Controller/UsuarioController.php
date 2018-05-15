<?php

namespace UsuariosBundle\Controller;

use UsuariosBundle\Form\UserType;
use UsuariosBundle\Entity\User;

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
        // $passwordEncoder = $this->get('security.password_encoder');
        // 1) build the form
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
            'usuarios/register.html.twig',
            array('form' => $form->createView(),
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
      // Selecciona por tipo de usuario
      if($lastUsername){
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            // Usuario con privilegios totales

        }
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CANDIDATO')) {
            // Candidato, sólo puede suscribirse a las ofertas

        }
        if ($this->get('security.authorization_checker')->isGranted('ROLE_EDITOR')) {
            // Usuario de tipo empresa CON permiso para crear ofertas
              return $this -> MuestraInicioEmpresa($lastUsername);     
        }
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // Usuario de tipo empresa SIN permiso para crear ofertas

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
      public function logout()
      {
        return $this->render('usuarios/index.html.twig');
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

    /* **************************************************
     * Funciones privadas
     * **************************************************
     */

    private function MuestraInicioEmpresa($email){

            // Busca los datos del usuario registrado
            $usuario = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('email' => $email));
            
             $form = $this->createForm(UserType::class, $usuario);
            
            // Busca las ofertas de la empresa
            $ofertas = $this->DameOfertasUsuarioEmpresa($usuario->getEmpresa());
            $filas = count($ofertas);
            // Falta buscar número de candidatos

            return $this->render('UsuariosBundle:Default:inicio.html.twig',
                array('form' => $form->createView(),
                    'nEmpresa'=>$usuario->getEmpresa(),
                    'empresa'=>$this->DameNombreEmpresa($usuario->getEmpresa()),
                    'usuario'=>$usuario->getId(),
                    'nombre'=>$usuario->getNombre(),
                    'ofertas'=> $ofertas,
                    'NumOfertas'=>$filas,
                    ));
    }

    private function DameNombreEmpresa($id){
        $repository = $this->getdoctrine()->getRepository('EmpresasBundle:Empresa')
                ->find($id);
        $nombre = $repository->getNombre();
        return $nombre;
    }

    private function DameOfertasUsuarioEmpresa($empresa){
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                    ->where('o.empresa  = :empresa ')
                    ->setParameter('empresa', $empresa)
                    ->orderBy('o.fecha', 'DESC')
                 ->getQuery();
                $ofertas = $consulta->getResult();
        Return $ofertas;

    }

   private function DameOfertas(){
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                    ->where('o.estado  = :estado ')
                    ->setParameter('estado', 1)
                    ->orderBy('o.fecha', 'DESC')
                 ->getQuery();
                $ofertas = $consulta->getResult();
        Return $ofertas;

    }
   

       

}
