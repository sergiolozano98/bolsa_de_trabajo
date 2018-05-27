<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudiosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('especialidad')
        ->add('fechaObtencion')
        ->add('id_Candidato',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Candidato'
        ))
        ->add('id_Estudios',EntityType::class, array(
            'class' => 'OfertasBundle:Estudios',
            'label' => 'Estudios'
        ))        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\Estudios'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_estudios';
    }


}
