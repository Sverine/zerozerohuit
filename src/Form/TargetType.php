<?php

namespace App\Form;

use App\Entity\Target;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label'=>'Prénom'])
            ->add('lastName',TextType::class, ['label'=>'Nom'])
            ->add('date_birth', BirthdayType::class,['label'=>'Date de naissance'])
            ->add('codeName',TextType::class, ['label'=>'Nom de code'])
            ->add('nationality', CountryType::class, ['label'=>'Nationalité'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Target::class,
        ]);
    }
}