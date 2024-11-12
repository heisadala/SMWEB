<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\GiftsTable;

class GiftsArchiveFormType extends AbstractType
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
            ->add('date')
            ->add('gift')
            ->add('url')
            ->add('Archive', SubmitType::class, [
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
