<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Votre adresse',
                ],
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Votre code postal',
                ],
            ])
            ->add('town', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Votre ville',
                ],
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => 'Pays',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
