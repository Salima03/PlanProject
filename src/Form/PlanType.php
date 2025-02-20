<?php

namespace App\Form;

use App\Entity\Plan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
                'label' => 'Type of plan',
                'required' => true,
            ])
            ->add('version', TextType::class, [
                'label' => 'Version',
                'required' => true,
            ])
            ->add('fichiers', FileType::class, [
                'label' => 'Importer des fichiers ou dossiers',
                'multiple' => true,
                'mapped' => false, // Ne pas mapper directement aux entités
                'required' => false,
                'attr' => [
                    'class' => 'custom-file-input', // Ajout de la classe CSS personnalisée
                    'webkitdirectory' => true, // Permet de sélectionner un dossier entier
                    'mozdirectory' => true,   // Pour Firefox
                    'accept' => '*',
                ],
            ]);
    }
}