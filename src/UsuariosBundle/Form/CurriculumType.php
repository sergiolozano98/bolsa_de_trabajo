<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurriculumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class, array('label' => 'Nombre'))
        ->add('direccion', TextType::class, array('label' => 'Direccion'))
        ->add('localidad', TextType::class, array('label' => 'Localidad'))
        ->add('telefono', TextType::class, array('label' => 'Telefono'))
        ->add('fechaNacimiento' ,DateType::class, array('label' => 'Fecha Nacimiento',
                    'empty_data'=> date_create(date('d-m-Y'))))
        ->add('DNI')
        ->add('carnet_conducir')
        ->add('vehiculo_propio')
        ->add('minusvalia')
        ->add('beca')
        ->add('cambio_residencia')
        ->add('puede_viajar')
        ->add('salario')
        ->add('comentario')
        ->add('foto')
        ->add('documento')
        ->add('fechaDeAlta', DateType::class, array('label' => 'Fecha Alta',
                    'empty_data'=> date_create(date('d-m-Y'))))
        ->add('fechaDeModificacion', DateType::class, array('label' => 'Fecha modificacion',
                    'empty_data'=> date_create(date('d-m-Y'))))
        ->add('id_Candidato',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Candidato'
        ))
        ->add('provincia',EntityType::class, array(
            'class' => 'EmpresBundle:Provincia',
            'label' => 'Estado'
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\Curriculum'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_curriculum';
    }


}
