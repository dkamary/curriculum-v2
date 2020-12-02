<?php

namespace App\Form;

use App\Entity\ExperienceSkill;
use App\Entity\Skill;
use App\Entity\SkillCategory;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurExperienceSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'skill',
                EntityType::class,
                [
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
                    'label' => 'Compétence',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExperienceSkill::class,
        ]);
    }
}
