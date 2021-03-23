<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\CompanyType;
use App\Entity\Country;
use App\Entity\Language;
use App\Entity\Nationality;
use App\Entity\User;
use App\Entity\UserType as TypeUser;
use App\Entity\UserType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UtilisateurInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('userType', EntityType::class, [
            //     'class' => TypeUser::class,
            //     'choice_label' => 'name',
            //     'query_builder' => function (EntityRepository $entityRepository) {
            //         $qb = $entityRepository->createQueryBuilder('t');

            //         return $qb->where($qb->expr()->neq('t.id', UserType::ADMIN))->orderBy('t.name', 'ASC');
            //     },
            //     'label' => 'Type utilisateur',
            //     'attr' => [
            //         'class' => 'd-none',
            //     ],
            // ])
            // ->add('companyType', EntityType::class, [
            //     'class' => CompanyType::class,
            //     'choice_label' => 'name',
            //     'label' => 'Type de société',
            //     'attr' => [
            //         'class' => 'd-none',
            //     ],
            // ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 1,
                    'Femme' => 2
                ],
            ])
            ->add('login', TextType::class, [
                'label' => 'Identifiant',
                'attr' => [
                    'placeholder' => 'Votre identifiant',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Votre adresse email',
                ],
            ])
            // ->add('password', PasswordType::class, [
            //     'label' => 'Mot de passe',
            //     'attr' => [
            //         'placeholder' => 'Votre mot de passe',
            //     ],
            // ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Votre Prénom'
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Votre Nom',
                ],
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'JJ/MM/AAAA',
                ],
                'widget' => 'single_text',
            ])
            ->add('birthplace', TextType::class, [
                'label' => 'Lieu de naissance',
                'attr' => [
                    'placeholder' => 'Votre lieu de naissance',
                ],
            ])
            ->add('nationality', EntityType::class, [
                'class' => Nationality::class,
                'choice_label' => 'name',
                'label' => 'Nationalité',
            ])
            ->add('language', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'name',
                'label' => 'Langue préférée',
            ])
            ->add('avatarPath', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'avatar-preview',
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez telecharger un fichier image valide',
                    ]),
                ],
            ])
            // ->add('bannerPath', FileType::class, [
            //     'label' => 'Banniere',
            //     'mapped' => false,
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'banner-preview',
            //     ],
            //     'constraints' => [
            //         new File([
            //             'mimeTypes' => [
            //                 'image/jpg',
            //                 'image/png',
            //                 'image/gif',
            //             ],
            //             'mimeTypesMessage' => 'Veuillez telecharger un fichier image valide',
            //         ]),
            //     ],
            // ])
            // ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $formEvent) {
            //     /**
            //      * @var User $user
            //      */
            //     $user = $formEvent->getData();
            //     if ($user->getId()) {
            //         $form = $formEvent->getForm();
            //         $form->add('avatar', AvatarType::class, [
            //             'label' => 'Avatar',
            //         ]);
            //     }
            // })
            // ->add('avatar', EntityType::class, [
            //     'class' => Asset::class,
            //     'choice_label' => 'path',
            //     'label' => 'Avatar',
            // ])
            // ->add('banner', EntityType::class, [
            //     'class' => Asset::class,
            //     'choice_label' => 'path',
            //     'label' => 'Bannière',
            // ])
            // ->add('userStat')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('deletedAt')
            // ->add('isActive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
