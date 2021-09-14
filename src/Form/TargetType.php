<?php

namespace App\Form;

use App\Entity\Target;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label'=>'Prénom',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
                ]
            ])
            ->add('lastName',TextType::class, [
                'label'=>'Nom',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
                ]
            ])
            ->add('date_birth', BirthdayType::class,[
                'label'=>'Date de naissance',
            ])
            ->add('codeName',TextType::class, [
                'label'=>'Nom de code',
                'constraints' => [
                    new Length(['min' => 5, 'max'=>100]),
                    new NotBlank()
                ]
            ])
            ->add('nationality', ChoiceType::class, [
                'label'=>'Nationalité',
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
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Target::class,
        ]);
    }
}
