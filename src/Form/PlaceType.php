<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => "City name"
                ]
            ])
            ->add('country_code', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'pl',
                    'Germany' => 'de',
                    'France' => 'fr',
                    'Spain' => 'es',
                    'Italy' => 'it',
                    'United Kingdom' => 'gb',
                    'United States' => 'us'
                ]
            ])
            ->add('x_axis', NumberType::class)
            ->add('y_axis', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
