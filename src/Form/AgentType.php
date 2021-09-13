<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Skill;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,[
                'label'=>'Prénom',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
                ]
            ])
            ->add('lastName',TextType::class,[
                'label'=>'Nom',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
                ]
            ])
            ->add('dateBirth',BirthdayType::class,[
                'label'=>'Date de naissance',
                'constraints'=>[
                    new Date()
                ]
            ])
            ->add('authCode', TextType::class,[
                'label'=>'Code d\'authentification',
                'constraints' => [
                    new Length(['min' => 3, 'max'=>50]),
                    new NotBlank()
                ]
            ])
            ->add('nationality',ChoiceType::class, [
                'label'=>'Nationalité',
                'choices'=>[
                    'France'=>'France',
                    'Allemagne'=>'Allemagne',
                    'Italie'=>'Italie',
                    'Angleterre'=>'Angleterre',
                    'Ecosse'=>'Ecosse',
                    'Thailande'=>'Thailande',
                    'Japon'=>'Japon',
                    'Chine'=>'Chine',
                    'Russie'=>'Russie',
                    'Australie'=>'Australie',
                    'Mexique'=>'Mexique',
                    'Etats-Unis'=>'Etats-Unis'
                ]
            ])
            ->add('skills', EntityType::class,[
                'class' => Skill::class,
                'multiple'=>true,
                'label'=>'Spécialité(s)'
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
