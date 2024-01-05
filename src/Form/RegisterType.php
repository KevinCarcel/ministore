<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minLenght'=>'2',
                    'maxLenght'=>'50'
                ],
                'label'=>'Mail',
                'label_attr'=>[
                    'class'=>'form-label',   
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min'=>2,'max'=>50])
                ]
            ])
            // ->add('roles')
            ->add('plainPassword',PasswordType::class,[
                'label'=>'Password',
                'label_attr'=>[
                    'class'=> 'form-label'
                ],
                'mapped'=>false,
                'attr'=>['autocomplete' => 'new-password','class'=>'form-control',
            ],
            'constraints'=> [
                new NotBlank([
                    'message'=>'please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
            ])

            ->add('nom',TextType::class,[
                'attr'=> [
                    'class'=> 'form-control',
                    'minLenght'=> '2',
                    'maxLenght'=> '50'
                    ],
                    'label'=> 'surname',
                    'label_attr'=> [
                        'class'=> 'form-label',
                        ],
                        'constraints'=> [
                            new Assert\Length(['min'=>2,'max'=>50])
                            ]
            ])

            ->add('prenom',TextType::class,[
                'attr'=> [
                    'class'=> 'form-control',
                    'minLenght'=> '2',
                    'maxLenght'=> '50'
                    ],
                    'label'=> 'Firstname',
                    'label_attr'=> [
                        'class'=> 'form-label',
                        ],
                        'constraints'=> [
                            new Assert\Length(['min'=>2,'max'=>50])
                            ]
            ])
            ->add('numTel',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'minLenght'=>'6',
                    'maxLenght'=> '10'
                ],
                'label'=> 'Phone number',
                'label_attr'=> [
                    'class'=>'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=>6,'max'=>10])
                ]
            ])
            ->add('numVoie',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'minLenght'=>'1',
                    'maxLenght'=> '10'
                ],
                'label'=> 'adress number',
                'label_attr'=> [
                    'class'=>'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=>1,'max'=>10])
                ]
            ])
            ->add('voie',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'minLenght'=>'10',
                    'maxLenght'=> '100'
                ],
                'label'=> 'adress',
                'label_attr'=> [
                    'class'=>'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=>10,'max'=>100])
                ]
            ])
    
            ->add('ville',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'minLenght'=>'2',
                    'maxLenght'=> '50'
                ],
                'label'=> 'City',
                'label_attr'=> [
                    'class'=>'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=>2,'max'=>50])
                ]
            ])
            ->add('codePostal',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control',
                    'minLenght'=>'2',
                    'maxLenght'=> '10'
                ],
                'label'=> 'Zip code',
                'label_attr'=> [
                    'class'=>'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=>2,'max'=>10])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'=>'RGPD',
                'label_attr'=> [
                    'class'=> 'decale',
                    ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('livraisonFav',ChoiceType::class, [
                'attr'=>['espace',
            ],
                'choices' => [
                    'Mondial Relay' => 'Mondial Relay',
                    'Domicile' => 'Domicile'
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}