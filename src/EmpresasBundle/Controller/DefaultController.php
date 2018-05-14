<?php

namespace EmpresasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use EmpresasBundle\Entity\Empresa;
use EmpresasBundle\Entity\Busqueda;
use EmpresasBundle\Form\EmpresaType;
use EmpresasBundle\Form\BusquedaType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
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

                // $empresas = $repository->findAll();
                /* $empresas= $repository->findByNombre(
                     array('nombre' => $Buscar),
                     array('nombre' => 'ASC')
                    );
                 */

                // ********************************************* //
                // ** Empresas ordenadas por orden alfabético ** //
                // ********************************************* //

                 $consulta = $repository->createQueryBuilder('e')
                    ->where('e.nombre  like :nombre or e.localidad  like :localidad')
                    ->setParameter('nombre', '%' . $cadena. '%')
                    ->setParameter('localidad', '%' . $cadena . '%')
                    ->orderBy('e.nombre', 'ASC')

                    ->getQuery(); 
            $empresas = $consulta->getResult(); 
            return $this->render('EmpresasBundle:Default:listado.html.twig', array( 'busqueda'=>$form->createView(),'empresas' =>$empresas, 'buscar' =>$cadena));
        }
        return $this->render('EmpresasBundle:Default:index.html.twig', array( 'busqueda'=>$form->createView()));
    }
}
