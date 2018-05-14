<?php

namespace EmpresasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
/* use Symfony\Component\Form\Extension\Core\Type\TelType; */
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array('label' => 'Nombre de Empresa'))
                ->add('cIF', TextType::class, array('label' => 'CIF'))
                ->add('descripcion', TextType::class,  array('label' => 'Descripción'))
                ->add('telefono', TextType::class, array('label' => 'Teléfono'))
                ->add('direccion', TextType::class, array('label' => 'Dirección'))
                ->add('cP', TextType::class, array('label' => 'Código postal'))
                ->add('localidad', TextType::class,  array('data' => 'Valencia','label' => 'Localidad'))
                /* ->add('provincia', array('label' => 'Provincia'))  */
                ->add('provincia', EntityType::class, array(
                    'class' => 'EmpresasBundle:Provincia',
                    'label' => 'Provincia'
                ))
                ->add('pais', TextType::class, array('data' => 'España','label' => 'País'))
                ->add('numEmpleados', TextType::class, array('label' => 'Número de empleados'))
                ->add('uRL', UrlType::class, array('data' => 'http://','label' => 'Dirección página web'))
                ->add('correo', EmailType::class, array('label' => 'Correo electrónico'))
                ->add('imagen', TextType::class, array('label' => 'Imagen/Logo'))
                ->add('observaciones', TextareaType::class, array('label' => 'Observaciones'))
                ->add('Guardar', SubmitType::class)
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmpresasBundle\Entity\Empresa'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'empresasbundle_empresa';
    }


}
