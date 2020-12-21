<?php

namespace App\Form;

use App\Entity\Experience;
use App\Entity\ExperienceSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', TextType::class, [
                'label' => 'Société',
                'attr' => [
                    'placeholder' => 'Le nom de la société',
                ],
            ])
            ->add('jobTitle', TextType::class, [
                'label' => 'Poste',
                'attr' => [
                    'placeholder' => 'Intitulé du poste',
                ],
            ])
            ->add('longDescription', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Décrivez votre expérience',
                ],
                'required' => false,
            ])
            ->add('start', DateType::class, [
                'label' => 'Debut',
                'attr' => [
                    'placeholder' => 'jj/mm/AAAA'
                ],
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('end', DateType::class, [
                'label' => 'Fin',
                'attr' => [
                    'placeholder' => 'jj/mm/AAAA',
                ],
                'widget' => 'single_text',
                'required' => false,
            ]);

        // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        //     /**
        //      * @var Experience $experience
        //      */
        //     $experience = $event->getData();
        //     $form = $event->getForm();
        //     if ($experience && $experience->getId()) {
        //         $form->add('experienceSkills', CollectionType::class, [
        //             'label' => 'Compétences utilisées',
        //             'entry_type' => UtilisateurExperienceSkillType::class,
        //             'entry_options' => ['label' => false],
        //             'allow_add' => true,
        //             'allow_delete' => true,
        //             'by_reference' => false,
        //         ]);
        //     }
        // });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
