<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diploma', TextType::class, [
                'label' => 'Diplome',
            ])
            ->add('school', TextType::class, [
                'label' => 'Etablissement'
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('start', DateType::class, [
                'label' => 'Début',
                'attr' => [
                    'placeholder' => 'JJ/MM/AAAA',
                ],
                'widget' => 'single_text',
            ])
            ->add('end', DateType::class, [
                'label' => 'Fin',
                'attr' => [
                    'placeholder' => 'JJ/MM/AAAA',
                ],
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Training::class,
        ]);
    }
}
