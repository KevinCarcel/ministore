<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('quantite')
            ->add('description')
            ->add('image' ,FileType::class, [
                'attr'=>[
                    'class'=> 'form-control'],
                                'required' => false,
                                'mapped' => false,
                                'constraints' => [
                                new Image(['maxSize' => '1024k'])
                                ],
                                'label'=>'Image',
                    'label_attr'=> [
                        'class'=> 'form-label mt-4'],
                    ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}