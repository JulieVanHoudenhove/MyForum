<?php

namespace App\Form;

use App\Entity\User;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo',
                'attr' => array(
                    'placeholder' => 'pseudo'
                ),
                'row_attr' => [
                    'class' => 'flex flex-col m-4 w-80'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'placeholder' => 'client@email.com'
                ),
                'row_attr' => [
                    'class' => 'flex flex-col m-4 w-80'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les conditions d\'utilisation',
                'row_attr' => [
                    'class' => 'flex flex-row-reverse justify-around m-4 w-80'
                ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisation.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être identique.',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => '****'],
                    'row_attr' => [
                        'class' => 'flex flex-col m-4 w-80'
                    ]
                ],
                'second_options' => ['label' => 'Confirmation du mot de passe',
                'attr' => array(
                    'placeholder' => '****'
                ),
                    'row_attr' => [
                    'class' => 'flex flex-col m-4 w-80'
                ]],
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être d\'au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
