<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => array(
                    'placeholder' => 'Votre titre...'
                ),
                'row_attr' => [
                    'class' => 'flex flex-col m-4 w-4/5'
                ]
                ])
            ->add('text', TextareaType::class, [
                'label' => 'Contenu du post',
                'attr' => array(
                    'rows' => 8,
                    'cols' => 30,
                    'placeholder' => 'Contenu de votre post...'
                ),
                'row_attr' => [
                    'class' => 'flex flex-col m-4 w-4/5'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Ajoutez une image',
                'row_attr' => [
                    'class' => 'flex flex-col m-4 w-4/5'
                ],
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/png, image/jpeg',
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Plese upload a valid JPEG/PNG image',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
