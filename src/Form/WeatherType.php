<?php

namespace App\Form;

use App\Entity\Weather;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('temperature', null, [
                'attr' => [
                    'placeholder' => "Temperature (°C)"
                ]
            ])
            ->add('humiditi', null, [
                'attr' => [
                    'placeholder' => "Humidity (%)"
                ]
            ])
            ->add('wind_speed', null, [
                'attr' => [
                    'placeholder' => "Wind speed (km/h)"
                ]
            ])
            ->add('pressure', null, [
                'attr' => [
                    'placeholder' => "Pressure (hPa)"
                ]
            ])
            ->add('UV', null, [
                'attr' => [
                    'placeholder' => "UV"
                ]
            ])
            ->add('weather_type', ChoiceType::class, [
                'choices' => [
                    'Sunny' => 'sunny',
                    'Cloudy' => 'cloudy',
                    'Foggy' => 'foggy',
                    'Raining' => 'raining',
                    'Snowing' => 'snowing',
                    'Hurricane' => 'hurricane'
                ]
            ])
            ->add('place', EntityType::class, [
                'class' => 'App\Entity\Place',
                'choice_label' => 'city'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
