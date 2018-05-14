<?php

namespace OfertasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class BuscarOfertaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', TextType::class, array('label' => 'Texto','required'  => false))
                ->add('provincia', EntityType::class, array(
                    'class' => 'OfertasBundle:ProvinciasOferta',
                    'label' => 'Provincia',
                    'required'  => false))
                ->add('localidad', TextType::class, array('label' => 'Localidad','required'  => false))
                ->add('beca',CheckboxType::class, array('label' => 'Beca','required'  => false))
                ->add('salario', EntityType::class, array(
                    'class' => 'OfertasBundle:Salario',
                    'label' => 'Salario',
                    'required'  => false))
                 ->add('tipoContrato', EntityType::class, array(
                    'class' => 'OfertasBundle:Contrato',
                    'label' => 'Tipo de contrato',
                    'required'  => false))
                ->add('jornadaLaboral', EntityType::class, array(
                    'class' => 'OfertasBundle:JornadaLaboral',
                    'label' => 'Tipo de jornada laboral',
                    'required'  => false))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OfertasBundle\Entity\Oferta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ofertasbundle_oferta';
    }


}
