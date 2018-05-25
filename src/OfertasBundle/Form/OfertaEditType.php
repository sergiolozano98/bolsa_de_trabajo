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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class OfertaEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', TextType::class, array('label' => 'Título Oferta'))
                ->add('fecha', DateType::class, array('label' => 'Fecha',
                            'empty_data'=> date_create(date('d-m-Y'))))
                ->add('usuario')
                ->add('estado', EntityType::class, array(
                    'class' => 'OfertasBundle:Estado',
                    'label' => 'Estado'
                ))
                ->add('descripcion', TextareaType::class, array('label' => 'Descripción oferta','attr' => array('rows' => '10','cols' => '10')))
                ->add('descripcionAlternativa', TextType::class, array('label' => 'Descripción de Empresa','required'   => false))
                ->add('puestos', NumberType::class, array('label' => 'Puestos vacantes'))
                ->add('lugarCentroTrabajo', TextType::class, array('label' => 'Lugar Centro de trabajo','required'  => false))
                ->add('provincia', EntityType::class, array(
                    'class' => 'OfertasBundle:ProvinciasOferta',
                    'label' => 'Provincia'
                ))
                ->add('localidad', TextType::class, array('label' => 'Localidad','required'  => false))
                ->add('pais', TextType::class, array('label' => 'País'))
                ->add('experienciaMinima', TextType::class, array('label' => 'Experiencia mínima','required'  => false))
                ->add('experienciaSector', ChoiceType::class, array('label' => 'Se requiere experiencia en el sector',
                    'required'  => false,
                    'choices'  => array(
                        'Sí' => true,
                        'No' => false,
                    )))
                ->add('salario', EntityType::class, array(
                    'class' => 'OfertasBundle:Salario',
                    'label' => 'Salario'
                ))
                 ->add('tipoContrato', EntityType::class, array(
                    'class' => 'OfertasBundle:Contrato',
                    'label' => 'Tipo de contrato'
                ))
                ->add('minusvalia',ChoiceType::class, array('label' => 'Minusvalía superior al 30%','required'  => false,
                    'choices'  => array(
                        'Sí' => true,
                        'No' => false,
                    )))
                ->add('jornadaLaboral', EntityType::class, array(
                    'class' => 'OfertasBundle:JornadaLaboral',
                    'label' => 'Tipo de jornada laboral'
                ))
                 ->add('beca',ChoiceType::class, array('label' => 'Beca','required'  => false,
                    'choices'  => array(
                        'Sí' => true,
                        'No' => false,
                    )))
                  ->add('categorias',EntityType::class,array(
                      'class' => 'OfertasBundle:Categoria',
                      'label' => false,
                      'multiple' => true,
                      'expanded' => true
                  ))
                  ->add('idiomas',EntityType::class,array(
                      'class' => 'OfertasBundle:Idioma',
                      'label' => false,
                      'multiple' => true,
                      'expanded' => true
                  ))
                  ->add('estudios',EntityType::class,array(
                      'class' => 'OfertasBundle:Estudios',
                      'label' => false,
                      'multiple' => true,
                      'expanded' => true
                  ))
                  ->add('conocimientos',EntityType::class,array(
                      'class' => 'OfertasBundle:Conocimientos',
                      'label' => false,
                      'multiple' => true,
                      'expanded' => true
                  ))
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
