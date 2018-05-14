<?php

namespace OfertasBundle\Controller;

use Doctrine\Common\Collections\Criteria;

use EmpresasBundle\Entity\Busqueda;
use EmpresasBundle\Form\BusquedaType;

use OfertasBundle\Entity\Oferta;
use OfertasBundle\From\OfertaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ofertum controller.
 *
 */
class OfertaController extends Controller
{
    /**
     * Lists all oferta entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ofertas = $em->getRepository('OfertasBundle:Oferta')->findAll();

        return $this->render('OfertasBundle:Default:index.html.twig', array(
            'ofertas' => $ofertas,
            'cadena'=> 'Últimas ofertas'. $cadena
        ));
    }

    /**
     * Creates a new oferta entity.
     *
     */
    public function newAction(Request $request)
    {
        $oferta = new Oferta();
        $form = $this->createForm('OfertasBundle\Form\OfertaType', $oferta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush($oferta);

            return $this->redirectToRoute('oferta_show', array('id' => $oferta->getId()));
        }

        return $this->render('OfertasBundle:Default:new.html.twig', array(
            'oferta' => $oferta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a oferta entity.
     *
     */
    public function showAction(Oferta $oferta)
    {
        $deleteForm = $this->createDeleteForm($oferta);

        return $this->render('OfertasBundle:Default:show.html.twig', array(
            'oferta' => $oferta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oferta entity.
     *
     */
    public function editAction(Request $request, Oferta $oferta)
    {
        $deleteForm = $this->createDeleteForm($oferta);
        $editForm = $this->createForm('OfertasBundle\Form\OfertaType', $oferta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oferta_edit', array('id' => $oferta->getId()));
        }

        return $this->render('OfertasBundle:Default:edit.html.twig', array(
            'oferta' => $oferta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Buscar ofertas.
     *
     */
    public function buscarAction(Request $request)
    {
        $Oferta = new Oferta;
        $BuscarForm = $this->createForm('OfertasBundle\Form\BuscarOfertaType', $Oferta);
        $BuscarForm->handleRequest($request);
        $cadena = 'Ofertas';
        /* Consulta de datos ofertas */
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        
        if ($BuscarForm->isSubmitted() && $BuscarForm->isValid()) {
            $busqueda= $BuscarForm->getData();
            

            $cadena=$busqueda->getTitulo();
           
            
            $cadenaSalario=$busqueda->getSalario();
            $cadenaLocalidad=$busqueda->getLocalidad();
            $cadenaProvincia=$busqueda->getProvincia();
            $cadenaContrato=$busqueda->getTipoContrato();
            $cadenaJornada=$busqueda->getJornadaLaboral();
            


             $consulta = $repository->createQueryBuilder('o')
                    ->where('o.titulo  like :cadena ')
                    ->orwhere(' o.descripcion like :cadena')
                    ->setParameter('cadena', '%' . $cadena. '%')
                    ->orderBy('o.fecha', 'DESC');
             
            /* Añade la consulta de la localidad */
            if (strlen($cadenaLocalidad)>=1){
                $criterio = Criteria::create()
                ->andwhere(Criteria::expr()->contains('o.localidad',$cadenaLocalidad));  
                $consulta->addCriteria($criterio);
            }
            /* Añade la consulta de la provincia */
            if (strlen($cadenaProvincia)>=1){
                $criterio = Criteria::create()
                ->andwhere(Criteria::expr()->eq('o.provincia',$cadenaProvincia));  
                $consulta->addCriteria($criterio);
            }
            /* Añade mla consulta del salario */
            if (strlen($cadenaSalario)>=1){
                $criterio = Criteria::create()
                ->andwhere(Criteria::expr()->eq('o.salario',$cadenaSalario));  
                $consulta->addCriteria($criterio);
            }
            
            /* Añade la consulta del Tipo de contrato */
            if (strlen($cadenaContrato)>=1){
                $criterio = Criteria::create()
                ->andwhere(Criteria::expr()->eq('o.tipoContrato',$cadenaContrato));  
                $consulta->addCriteria($criterio);
            }
              
            /* Añade la consulta del Tipo de jornada laboral */
            if (strlen($cadenaJornada)>=1){
                $criterio = Criteria::create()
                ->andwhere(Criteria::expr()->eq('o.jornadaLaboral',$cadenaJornada));  
                $consulta->addCriteria($criterio);
            }
            
            $Oferta =  $consulta->getQuery()->getResult();
            $filas = count($Oferta);
            return $this->render('OfertasBundle:Default:index.html.twig', array(
                'ofertas' => $Oferta,
                'cadena'=> 'Resultado búsqueda : '.$filas.' ofertas encontradas'
        ));
        } else {
            /* Consulta de datos ofertasas */
                $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');

                $consulta = $repository->createQueryBuilder('e')
                    ->where('e.estado=1')
                    ->orderBy('e.fecha', 'DESC')
                ->getQuery();

                $Oferta = $consulta->getResult();
                $filas = count($Oferta);
        }
        
        

        return $this->render('OfertasBundle:Default:buscar.html.twig', array(
            'ofertas' => $Oferta,
            'Buscar_form' => $BuscarForm->createView(),
            'cadena'=>  $cadena));
    }
    
    



    /**
     * Deletes.
     *
     */
    public function deleteAction(Request $request, Oferta $oferta)
    {
        $form = $this->createDeleteForm($oferta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oferta);
            $em->flush($oferta);
        }

        return $this->redirectToRoute('oferta_index');
    }

    /**
     * Creates a form to delete a oferta entity.
     *
     * @param Oferta $oferta The oferta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oferta $oferta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oferta_delete', array('id' => $oferta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
