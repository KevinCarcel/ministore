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

class LoginType extends AbstractType
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
          ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}