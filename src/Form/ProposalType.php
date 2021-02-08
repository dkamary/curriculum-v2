<?php

namespace App\Form;

use App\Entity\Proposal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProposalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence'
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'offre'
            ])
            ->add('longDescription', TextareaType::class, [
                'label' => 'Description de l\'offre',
                'attr' => [
                    'rows' => 7,
                ]
            ])
            ->add('start', DateType::class, [
                'label' => 'Début',
                'attr' => [
                    'placeholder' => 'jj/mm/AAAA'
                ],
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('end', DateType::class, [
                'label' => 'Fin',
                'attr' => [
                    'placeholder' => 'jj/mm/AAAA'
                ],
                'widget' => 'single_text',
                'required' => false,
            ])
            // ->add('featuredImage')
            // ->add('bannerImage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proposal::class,
        ]);
    }
}
