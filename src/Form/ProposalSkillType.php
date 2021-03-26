<?php

namespace App\Form;

use App\Entity\ProposalSkill;
use App\Entity\Skill;
use App\Entity\SkillLevel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProposalSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('proposal')
            ->add('skill', EntityType::class, [
                'class' => Skill::class,
                'label' => 'Compétences',
                'choice_label' => 'name',
            ])
            ->add('level', EntityType::class, [
                'class' => SkillLevel::class,
                'label' => 'Niveau',
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProposalSkill::class,
        ]);
    }
}
