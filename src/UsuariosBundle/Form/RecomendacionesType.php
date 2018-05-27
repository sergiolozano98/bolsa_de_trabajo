<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecomendacionesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('visualizarse')
        ->add('especialidad')
        ->add('fechaEnviado')
        ->add('fechaRecomendacion')
        ->add('comentarios')
        ->add('id_Candidato',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Candidato'
        ))
        ->add('id_UsuarioEmpresas',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Usuario empresa'
        ))      ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\Recomendaciones'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_recomendaciones';
    }


}
