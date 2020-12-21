<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\LanguageKnowledge;
use App\Entity\LanguageLevel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLanguageKnowledgeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('language', EntityType::class, [
                'label' => 'Langue',
                'class' => Language::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    $qb = $entityRepository->createQueryBuilder('t');

                    return $qb->orderBy('t.name', 'ASC');
                },
            ])
            ->add('level', EntityType::class, [
                'label' => 'Niveau',
                'class' => LanguageLevel::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    $qb = $entityRepository->createQueryBuilder('t');

                    return $qb->orderBy('t.rank', 'ASC');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => LanguageKnowledge::class,
        ]);
    }
}
