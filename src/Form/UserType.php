<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UserType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('Nom')
            ->add('Prenom')
            ->add('NomSociete')
            ->add('Adresse');

        // Only add the password field if it's a new user or editing an existing one
        if (!$options['data'] || ($options['data'] && $options['data']->getId())) {
            $builder->add('password', PasswordType::class, [
                'required' => false, // Password field is not required
                'mapped' => false, // This field is not mapped to the entity property
                'attr' => ['autocomplete' => 'new-password'], // Prevent browser autofill
            ]);
        }

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
