<?php
namespace UsuariosBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $editor= "ROLE_EDITOR";
      $admin = "ROLE_ADMIN";
      $user = "ROLE_USER";
        $builder
            ->add('email', EmailType::class, array('label' => 'Correo electrónico'))
            ->add('nombre', TextType::class, array('label' => 'Nombre'))
            ->add('username', hiddenType::class, array('label' => 'Username','data' => 'abcdef',))
            ->add('nif', TextType::class, array('label' => 'NIF'))
            ->add('plainPassword', RepeatedType::class, array(
                'type'              => PasswordType::class,
                'first_options'     => array('label' => 'Contraseña'),
                'second_options'    => array('label' => 'Repita contraseña')))
             ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuariosBundle\Entity\User'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariosbundle_user';
    }
}