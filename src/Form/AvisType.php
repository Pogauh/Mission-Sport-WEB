<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\Produit;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentaire',TextType::class, ['label' => 'Commentaire','attr' => ['class'=> 'form-control'],'label_attr' => ['class'=> 'fw-bold']] )
            ->add('note', ChoiceType::class, [
                'label' => 'Note',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'fw-bold'],
                'choices' => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('prenom', TextType::class, ['label' => 'Prénom','attr' => ['class'=> 'form-control'],'label_attr' => ['class'=> 'fw-bold']])
            ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
