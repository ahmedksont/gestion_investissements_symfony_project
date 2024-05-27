<?php

namespace App\Form;

use App\Entity\Convention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;

class ConventionType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDebut')
            ->add('projectId', HiddenType::class, [
                'mapped' => false,
                'data' => $options['project_id'],
            ])
            ->add('Mat', HiddenType::class, [
                'data' => $this->security->getUser(), // Pass the current user entity as the data
                'mapped' => false, // Since Mat is a ManyToOne relation, it's likely not supposed to be mapped directly in the form
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Convention::class,
            'project_id' => null,
        ]);
    }
}
