<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', null, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control'
                ]
            ])
            ->add('birthDate', BirthdayType::class, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Date de naissance',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
