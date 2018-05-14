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

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
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

          return $this->render('usuarios/login.html.twig', array(
              'last_username' => $lastUsername,
              'error'         => $error,
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

    private function ResuelveConTipoUsuario($result, $form){
        if ($result["empresa"]>=2) {
            // Muestra el usuario de la empresa
            return $this -> MuestraInicioEmpresa($result, $form);
        } else {
            return 'Candidato';
        }


    }


    private function MiraAcceso($email, $pass){
        $id=0;
        $empresa=-2;
        $nombre='';
        $frase='Usuario no encontrado';

            $consulta = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('username' => $email));
            if ($consulta) {
                // Mira si la contraseña es correcta
                $consultaPass = $this->getDoctrine()->getRepository(User::class)
                ->findOneBy( array('username' => $email,'pass' => $pass));
                if ($consultaPass) {
                    $id = $consultaPass->getId();
                    $empresa =$consultaPass->getEmpresa();
                    $nombre = $consultaPass->getNombre();
                } else {
                $frase = 'Contraseña incorrecta';
                }
            } else {
                $frase = 'Usuario incorrecto';
            }
            // Devielve el código de usuario, empresa asociada y en su defecto el error
            return ['id' => $id, 'empresa'=> $empresa, 'nombre'=>$nombre, 'frase' =>$frase];
    }

    private function MuestraInicioEmpresa($result,$form){
                    $ofertas = $this->DameOfertasUsuarioEmpresa($result["empresa"]);
                    $filas = count($ofertas);
                    // Falta buscar número de candidatos

                    return $this->render('UsuariosBundle:Default:inicio.html.twig',
                        array('form' => $form->createView(),
                            'nEmpresa'=>$result["empresa"],
                            'empresa'=>$this->DameNombreEmpresa($result["empresa"]),
                            'usuario'=>$result["id"],
                            'nombre'=>$result["nombre"],
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


}
