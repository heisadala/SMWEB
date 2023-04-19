<?php

namespace App\Form;

use App\Entity\LegoTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegoUpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('name')
            ->add('theme')
            ->add('price')
            ->add('date')
            ->add('state')
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LegoTable::class,
        ]);
    }
}
