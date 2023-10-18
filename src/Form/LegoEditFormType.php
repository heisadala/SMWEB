<?php

namespace App\Form;

use App\Entity\LegoTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegoEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // dd($options['data']->getReference());
        // foreach ($options['data'] as $row) {
        //     // dd($row->getName());
        //     array_push($allowedThemes, $row->getName());
        // }
        $builder
            ->add('reference')
            ->add('name', TextType::class, [
                'attr' => [
                    'oninput'=> 'legoFormCheckValidity(this)',
                ],
                'required' => true
            ])
            ->add('name')
            ->add('theme')
            ->add('price')
            ->add('date', BirthdayType::class, [
                'disabled' => true,
            ])
            ->add('state')
            ->add('url')
            ->add('Update', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-warning'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LegoTable::class,
            'attr' => [
                'readonly' => false,
            ],
]);
    }
}
