<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextareaType::class,[
                'label'=>'Adresse',
                'constraints' => [
                    new Length(['min' => 5, 'max'=>250]),
                    new NotBlank()
                ]
            ])
            ->add('country', ChoiceType::class, [
                'label'=>'Pays',
                'choices'=>[
                    'France'=>'France',
                    'Allemagne'=>'Allemagne',
                    'Italie'=>'Italie',
                    'Angleterre'=>'Angleterre',
                    'Thailande'=>'Thailande',
                    'Japon'=>'Japon',
                    'Chine'=>'Chine',
                    'Russie'=>'Russie',
                    'Australie'=>'Australie',
                    'Mexique'=>'Mexique',
                    'Etats-Unis'=>'Etats-Unis'
                    ]
                ])
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
            ->add('code', TextType::class, [
                'label'=>'Code',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
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
