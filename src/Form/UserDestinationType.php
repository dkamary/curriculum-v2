<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserDestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', EntityType::class, [
                'label' => 'Pays de destination',
                'class' => Country::class,
                'choice_label' => 'name',
            ]);
    }
}
