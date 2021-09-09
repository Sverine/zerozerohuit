<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, ['label'=>'Code'])
            ->add('address', TextareaType::class,['label'=>'Adresse'])
            ->add('country', CountryType::class, ['label'=>'Pays'])
            ->add('type', ChoiceType::class,[
                'label'=>'Type',
                'choices'=>[
                    'Grand luxe - Palace'=>'Palace',
                    'Luxe - Hotel 5*'=>'Hotel 5*',
                    'Confortable - Hotel Moyen'=>'Hotel confortable',
                    'Economique - Formule 1'=>'Hotel économique',
                    'Gratuit - Tente'=>'Tente'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
