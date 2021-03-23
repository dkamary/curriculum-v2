<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\AssetType as EntityAssetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('path', UrlType::class, [
                'label' => 'Chemin vers le fichier',
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('deletedAt')
            // ->add('owner')
            ->add('assetType', EntityType::class, [
                'label' => 'Type',
                'class' => EntityAssetType::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}
