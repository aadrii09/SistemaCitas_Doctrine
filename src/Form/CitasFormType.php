<?php

namespace App\Form;

use App\Entity\Cliente;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitasFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('hora', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('motivo')
            ->add('localizacion')
            ->add('confirmada')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
