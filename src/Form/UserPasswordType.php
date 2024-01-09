<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('PlainPassword', PasswordType::class, [
            'attr' => ['class'=>'form-control'],
            'label'=> 'Ancien mot de passe',
            'label_attr'=> ['class'=>'form-label mt-4'],
            'constraints'=> [new Assert\NotBlank()]
        ])
        ->add('NewPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options'  => ['label' => 'Nouveau mot de passe'],
            'second_options' => ['label' => 'Confirmez le nouveau mot de passe'],
            'invalid_message' => 'Les mots de passe ne correspondent pas',
        ])
        ->add('submit', SubmitType::class, [
            'attr'=> ['class'=> 'btn btn-primary mt-4'],
            'label'=> 'Changer mon mot de passe',
        ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => User::class,
    ]);
  }
}

?>