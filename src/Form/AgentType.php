<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Skill;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,['label'=>'Prénom'])
            ->add('lastName',TextType::class,['label'=>'Nom'])
            ->add('dateBirth',BirthdayType::class,['label'=>'Date de naissance'])
            ->add('authCode', TextType::class,['label'=>'Code d\'authentification'])
            ->add('nationality',CountryType::class, ['label'=>'Nationalité'])
            ->add('skills', EntityType::class,[
                'class' => Skill::class,
                'multiple'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
