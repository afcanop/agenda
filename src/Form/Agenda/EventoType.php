<?php

namespace App\Form\Agenda;

use App\Entity\Agenda\Evento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class)
            ->add('nombre', TextType::class)
            ->add('fechaInicio', DateType::class, ['widget' => 'single_text'])
            ->add('fechaFin', DateType::class, ['widget' => 'single_text'])
            ->add('descripcion', TextareaType::class)
            ->add('limpiar', ResetType::class, array('label' => 'Limpiar formulario'))
            ->add('guardar', SubmitType::class, array('label' => 'Crear evento'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
