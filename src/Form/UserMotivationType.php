<?php

namespace App\Form;

use App\Entity\ContractType;
use App\Entity\UserMotivation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserMotivationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => UserMotivation::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation',
                'attr' => [
                    'placeholder' => 'Présentez-vous',
                ]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $formEvent) {
                $form = $formEvent->getForm();
                /**
                 * @var UserMotivation $userMotivation
                 */
                $userMotivation = $formEvent->getData();
                $user = $userMotivation->getOwner();
                if (!is_null($user) && in_array('ROLE_USER', $user->getRoles())) {
                    $form
                        ->add('contract', EntityType::class, [
                            'label' => 'Type de contrat désiré',
                            'choice_label' => 'name',
                            'class' => ContractType::class,
                            'query_builder' => function (EntityRepository $entityRepository) {
                                $qb = $entityRepository->createQueryBuilder('c');

                                return $qb->orderBy('c.name', 'ASC');
                            }
                        ])
                        ->add('isTraveller', ChoiceType::class, [
                            'label' => 'Voulez-vous voyager ?',
                            'choices' => [
                                'Oui' => true,
                                'Non' => false,
                            ],
                            // 'data' => false,
                        ]);
                }
            });
    }
}
