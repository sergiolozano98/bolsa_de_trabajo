<?php

namespace EmpresasBundle\Controller;

use EmpresasBundle\Entity\Empresa;
use EmpresasBundle\Entity\Busqueda;
use OfertasBundle\Entity\Oferta;
use UsuariossBundle\Entity\User;

/* use EmpresasBundle\Form\EmpresaType; */
use EmpresasBundle\Form\BusquedaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * Empresa controller.
 *
 */
class EmpresasController extends Controller
{
    /**
     * Lists all empresa entities.
     *
     */
    public function indexAction(Request $request)
    {
        
        
        $busqueda = new Busqueda(); 
        $form= $this->createForm(BusquedaType::class,$busqueda); 
        $cadena='Nombre de empresa';
        
        $em = $this->getDoctrine()->getManager();
        $empresas = $em->getRepository('EmpresasBundle:Empresa')->findAll();

        return $this->render('EmpresasBundle:Default:index.html.twig', array( 
            'busqueda'=>$form->createView(),
            'empresas' =>$empresas,
            'buscar' =>$cadena));
    }

     /**
     * Lists all empresa entities.
     *
     */
    public function inicioAction(Request $request, $empresa,$usuario)
    {
        return $this->render('EmpresasBundle:Default:inicio.html.twig', array( 
            'usuario'=>$usuario,
            'empresa' =>$empresa));
    }
    
    /**
     * Creates a new empresa entity.
     *
     */
    public function newAction(Request $request)
    {
        $empresa = new Empresa();
        $form = $this->createForm('EmpresasBundle\Form\EmpresaType', $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresa);
            $em->flush($empresa);

            return $this->redirectToRoute('empresa_show', array('id' => $empresa->getId()));
        }

        return $this->render('EmpresasBundle:Default:nuevo.html.twig', array(
            'empresa' => $empresa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Listado de la empresa entity.
     *
     */
    public function listadoAction(Request $request)
    {
        $busqueda = new Busqueda(); 
        $form= $this->createForm(BusquedaType::class,$busqueda); 
        $cadena='Nombre de empresa';
        
        /* Consulta de datos empresas */
        $repository = $this->getdoctrine()->getRepository('EmpresasBundle:Empresa');

                $consulta = $repository->createQueryBuilder('e')
                ->orderBy('e.nombre', 'ASC')
                ->getQuery();
                
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $busqueda= $form->getData();
            $cadena=$busqueda->getCampoBusqueda();

                 $consulta = $repository->createQueryBuilder('e')
                    ->where('e.nombre  like :nombre or e.localidad  like :localidad')
                    ->setParameter('nombre', '%' . $cadena. '%')
                    ->setParameter('localidad', '%' . $cadena . '%')
                    ->orderBy('e.nombre', 'ASC')

                    ->getQuery();  
        }
        
        $empresas = $consulta->getResult(); 
        return $this->render('EmpresasBundle:Default:listado.html.twig', array( 
            'busqueda'=>$form->createView(),
            'empresas' =>$empresas,
            'buscar' =>$cadena));
    }
    
    /**
     * Finds and displays a empresa entity.
     *
     */
    public function showAction(Empresa $empresa)
    {
        
        $busqueda = new Busqueda(); 
        $form= $this->createForm(BusquedaType::class,$busqueda); 
        $cadena='Nombre de empresa';
        
        $Oferta = $this->BuscaOfertasEmpresa($empresa->getId());
        $filas = count($Oferta);
        $Usuarios = $this->BuscaUsuariosEmpresa($empresa->getId());
        
        if ($form->isSubmitted() && $form->isValid()) {
            $busqueda= $form->getData();
            $cadena=$busqueda->getCampoBusqueda();

                 $consulta = $repository->createQueryBuilder('e')
                    ->where('e.nombre  like :nombre or e.localidad  like :localidad')
                    ->setParameter('nombre', '%' . $cadena. '%')
                    ->setParameter('localidad', '%' . $cadena . '%')
                    ->orderBy('e.nombre', 'ASC')
                    ->getQuery();  
                $empresas = $consulta->getResult(); 
                return $this->redirectToRoute('empresa_listado', array(
                    'busqueda'=>$form->createView(),
                    'empresas' =>$empresas,
                    'buscar' =>$cadena,
                    'ofertas' =>$Oferta,
                    'usuarios'=>$Usuarios,
                    'NumOfertas'=>$filas));
        } else {
            $deleteForm = $this->createDeleteForm($empresa);

            return $this->render('EmpresasBundle:Default:show.html.twig', array(
                'empresa' => $empresa,
                'delete_form' => $deleteForm->createView(),
                'busqueda'=>$form->createView(),
                'buscar' =>$cadena,
                'ofertas' =>$Oferta,
                'usuarios'=>$Usuarios,
                'NumOfertas'=>$filas
            ));
        }
    }

    /**
     * Displays a form to edit an existing empresa entity.
     *
     */
    public function editAction(Request $request, Empresa $empresa)
    {
        $deleteForm = $this->createDeleteForm($empresa);
        $editForm = $this->createForm('EmpresasBundle\Form\EmpresaType', $empresa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('empresa_edit', array('id' => $empresa->getId()));
        }

        return $this->render('EmpresasBundle:Default:edit.html.twig', array(
            'empresa' => $empresa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a empresa entity.
     *
     */
    public function deleteAction(Request $request, Empresa $empresa)
    {
        $form = $this->createDeleteForm($empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($empresa);
            $em->flush($empresa);
        }

        return $this->redirectToRoute('empresa_index');
    }

    /**
     * Creates a form to delete a empresa entity.
     *
     * @param Empresa $empresa The empresa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Empresa $empresa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empresa_delete', array('id' => $empresa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function BuscaOfertasEmpresa($Id){
        /* Obtiene las ofertas de la empresa */
        
        
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');

        $consulta = $repository->createQueryBuilder('e')
            ->where('e.empresa =:empresa')
            ->setParameter('empresa', $Id)
        ->orderBy('e.fecha', 'DESC')
        ->getQuery();
        $Oferta = $consulta->getResult(); 
        return $Oferta;
    }
    
    public function BuscaUsuariosEmpresa($Id){
        /* Obtiene las ofertas de la empresa */
        
        $repository = $this->getdoctrine()->getRepository('UsuariosBundle:User');

        $consulta = $repository->createQueryBuilder('e')
            ->where('e.empresa =:empresa')
            ->setParameter('empresa', $Id)
        ->getQuery();
        $Usuario = $consulta->getResult(); 
        return $Usuario;
    }    
            
}
