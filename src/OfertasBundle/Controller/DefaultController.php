<?php

namespace OfertasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use EmpresasBundle\Entity\Busqueda;
use EmpresasBundle\Form\BusquedaType;

use OfertasBundle\Entity\Oferta;
use OfertasBundle\From\OfertaType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        
        $cadena='Título de Oferta';
        
        /* Consulta de datos ofertasas */
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');

                $consulta = $repository->createQueryBuilder('e')
                    ->where('e.estado=1')
                    ->orderBy('e.id', 'ASC')
                ->getQuery();

        $ofertas = $consulta->getResult(); 
        return $this->render('OfertasBundle:Default:index.html.twig', array(
            'ofertas' =>$ofertas,
            'buscar' =>$cadena,
            'cadena'=> 'Últimas ofertas'));
    }
}
