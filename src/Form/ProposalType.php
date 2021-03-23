<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Proposal;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('town', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'label' => 'Pays',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
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
