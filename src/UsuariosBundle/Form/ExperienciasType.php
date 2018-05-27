<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienciasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('puestoTrabajo')
        ->add('descripcion')
        ->add('expecialidad')
        ->add('empresa')
        ->add('duracion')
        ->add('fechaFin')
        ->add('fechaInicio')
        ->add('experienciaSector')
        ->add('id_Candidato',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Candidato'
        ))        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\Experiencias'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_experiencias';
    }


}
