<?php

namespace App\Form;
use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Traitement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraitementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   $builder
                 ->add('description', TextareaType::class, [
                'label' => 'Description du traitement',
                'attr' => ['rows' => 4, 'placeholder' => 'Détail du traitement effectué...']
            ])
            ->add('cout', MoneyType::class, [
                'label' => 'Coût du traitement',
                'attr' => ['placeholder' => '150.00']
            ])
            ->add('dateTraitement', DateType::class, [
                'label' => 'Date du traitement',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
                'choice_label' => function (Patient $patient) {
                    return $patient->getPrenom() . ' ' . $patient->getNom();
                },
                'placeholder' => 'Sélectionnez un patient',
                'label' => 'Patient concerné'
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut du traitement',
                'choices' => [
                    'Proposé' => 'Proposé',
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'Annulé' => 'Annulé',
                ],
                'placeholder' => 'Sélectionnez un statut'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Traitement::class,
        ]);
    }
}
