<?php

namespace App\Form;

use DateTime;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Titre du film',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'placeholder' => 'Il était une fois dans l\'ouest',
                    'class' => 'form-control'
                ]
            ])
            ->add('poster', FileType::class, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Affiche du film',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'placeholder' => 'Choisir un fichier',
                    'class' => 'form-control'
                ]
            ] )
            ->add('duration', null, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Durée (en minutes)',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('releaseAt', DateType::class, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Date de sortie en France',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
            ->add('genre', null, [
                'row_attr' => [
                    'class' =>'mb-3'
                ],
                'label' => 'Genre',
                'label_attr' => [
                    'class' => 'text-primary fw-light',
                ],
                'attr' => [
                    'class' => 'form-select'
                ],
                'query_builder' => function (GenreRepository $gr) {
                    return $gr->createQueryBuilder('c')
                        ->orderBy('c.designation', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
