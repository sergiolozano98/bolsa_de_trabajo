<?php

namespace UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdiomasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nivelConocimiento')
        ->add('id_Candidato',EntityType::class, array(
            'class' => 'UsuariosBundle:User',
            'label' => 'Candidato'
        ))
        ->add('idioma',EntityType::class, array(
            'class' => 'OfertasBundle:Idioma',
            'label' => 'Idioma'
        ))        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\Idiomas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_idiomas';
    }


}
