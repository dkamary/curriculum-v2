<?php

namespace App\Form;

use App\Entity\OtherSkill;
use App\Entity\Skill;
use App\Entity\SkillCategory;
use App\Entity\SkillLevel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserOtherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skill', EntityType::class, [
                'label' => 'Compétence',
                'class' => Skill::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('s')
                        ->join(SkillCategory::class, 'c', Expr\Join::WITH, 's.category = c.id')
                        ->orderBy('c.name', 'ASC');
                },
                'group_by' => function ($skill, $key, $value) {
                    /**
                     * @var Skill $skill
                     */
                    return $skill->getCategory()->getName();
                },
            ])
            ->add('level', EntityType::class, [
                'label' => 'Niveau',
                'class' => SkillLevel::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('sl')
                        ->orderBy('sl.rank', 'ASC');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => OtherSkill::class,
        ]);
    }
}
