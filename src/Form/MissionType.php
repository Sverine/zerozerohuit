<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Place;
use App\Entity\Skill;
use App\Entity\Target;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label'=>'Titre'])
            ->add('description', TextareaType::class, ['label'=>'Description'])
            ->add('codeName', TextType::class, ['label'=>'Nom de code'])
            ->add('country',ChoiceType::class, [
                'label'=>'Pays',
                'choices'=>[
                    '--'=>'--',
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
            ->add('contacts', EntityType::class,[
                'class'=> Contact::class,
                'multiple'=>true,
                'label'=>'Contact(s)'
            ])
            ->add('places',EntityType::class,[
                'class'=>Place::class,
                'multiple'=>true,
                'label'=>'Planque(s)'
            ])
            ->add('skill',EntityType::class,[
                'class'=>Skill::class,
                'label'=>'Sp??cialit?? requise'
            ])
            ->add('agents', EntityType::class,[
                'class'=> Agent::class,
                'multiple'=>true,
                'label'=>'Agent(s)'
            ])
            ->add('targets', EntityType::class,[
                'class'=> Target::class,
                'multiple'=>true,
                'label'=>'Cibles(s)'
            ])
            ->add('type',ChoiceType::class,[
                'choices'=>[
                    'Surveillance'=>'Surveillance',
                    'Assassinat'=>'Assassinat',
                    'Infiltration'=>'Infiltration'
                ],
                'label'=>'Type'
            ])
            ->add('status', ChoiceType::class,[
                'choices'=>[
                    'En pr??paration'=>'En pr??paration',
                    'En cours'=>'En cours',
                    'Termin??'=>'Termin??',
                    'Echec'=>'Echec'
                ],
                'label'=>'Statut'
            ])
            ->add('date_start', DateType::class,['label'=>'Date de d??but'])
            ->add('date_end', DateType::class, ['label'=>'Date de fin'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
