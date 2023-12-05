<?php

namespace App\Form;

use App\Entity\GiftsTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiftsDeleteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // dd($options['data']->getReference());
        // foreach ($options['data'] as $row) {
        //     // dd($row->getName());
        //     array_push($allowedThemes, $row->getName());
        // }
        $builder
            ->add('name', null, [
                'required' => false,
            ])
            ->add('gift')
            ->add('url')
            ->add('Delete', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-warning'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiftsTable::class,
            'attr' => [
                'readonly' => true,
            ],
]);
    }
}
