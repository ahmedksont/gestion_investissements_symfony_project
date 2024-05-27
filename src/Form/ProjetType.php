<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('LibelleP', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('SecteurP', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('CoutFixe', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('CoutVar', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('DureeP', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('PictureUrl', null, [
                'attr' => ['class' => 'form-input']
            ])
            ->add('convention', null, [
                'attr' => ['class' => 'form-input']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
