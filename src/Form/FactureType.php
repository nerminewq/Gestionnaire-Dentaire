<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Patient;
use App\Entity\Traitement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroFacture', TextType::class, [
                "label" => "Numéro de facture",
                "attr" => ["placeholder" => "FAC-2025-001"]
            ])
            ->add('dateFacture', DateType::class, [
                "label" => "Date de la facture",
                "widget" => "single_text",
                "html5" => true,
            ])
            ->add('patient', EntityType::class, [
                "class" => Patient::class,
                "choice_label" => function (Patient $patient) {
                    return $patient->getPrenom() . " " . $patient->getNom();
                },
                "placeholder" => "Sélectionnez un patient",
                "label" => "Patient concerné"
            ])
            ->add('traitements', EntityType::class, [
                "class" => Traitement::class,
                "choice_label" => function (Traitement $traitement) {
                    return $traitement->getDescription() . " (" . $traitement->getDateTraitement()->format("d/m/Y") . ")";
                },
                "multiple" => true,
                "expanded" => true,
                "label" => "Traitements inclus",
                "required" => false,
                "attr" => ["class" => "select2"],
                'by_reference' => false,
            ])
                ->add('montantTotal', MoneyType::class, [
            "label" => "Montant total de la facture",
            "attr" => ["placeholder" => "350.00"]
        ])

        
            ->add('statutPaiement', ChoiceType::class, [
                "label" => "Statut du paiement",
                "choices" => [
                    "En attente" => "En attente",
                    "Payée" => "Payée",
                    "Partiellement payée" => "Partiellement payée",
                    "Annulée" => "Annulée",
                ],
                "placeholder" => "Sélectionnez un statut"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Facture::class,
        ]);
    }
}
