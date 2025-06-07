<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\RendezVous;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('dateRdv', DateType::class, [
            'label' => 'Date du rendez-vous',
            'widget' => 'single_text',
            'html5' => true,
        ])
        ->add('heureRdv', TimeType::class, [
            'label' => 'Heure du rendez-vous',
            'widget' => 'single_text',
            'html5' => true,
        ])
        ->add('patient', EntityType::class, [
            'class' => Patient::class,
            'choice_label' => function (Patient $patient) {
                return $patient->getPrenom() . ' ' . $patient->getNom();
            },
            'placeholder' => 'Sélectionnez un patient',
            'label' => 'Patient'
        ])

        ->add('motif', TextareaType::class, [
            'label' => 'Motif du rendez-vous',
            'required' => false,
            'attr' => ['rows' => 3, 'placeholder' => 'Consultation, Détartrage, etc.']
        ])
        ->add('statut', ChoiceType::class, [
            'label' => 'Statut du rendez-vous',
            'choices' => [
                'Planifié' => 'Planifié',
                'Confirmé' => 'Confirmé',
                'Annulé' => 'Annulé',
                'Réalisé' => 'Réalisé',
            ],
            'placeholder' => 'Sélectionnez un statut',
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
