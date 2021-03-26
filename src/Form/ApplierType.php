<?php

namespace App\Form;

use App\Entity\Applier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('applyDate')
            ->add('isValidate')
            ->add('validateDate')
            ->add('owner')
            ->add('proposal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Applier::class,
        ]);
    }
}
