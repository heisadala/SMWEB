<?php

namespace App\Form;

use App\Entity\PromoTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class PromoAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marchand', TextType::class, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'placeholder' => 'Marchand *',
                    'oninput'=> 'promoFormCheckValidity(this)',
                ],
                'required' => true
            ])            
            ->add('code', TextType::class, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'placeholder' => 'Code *',
                    'oninput'=> 'promoFormCheckValidity(this)',
                ],
                'required' => true
            ])
            ->add('validite', BirthdayType::class, [
                //   'years' => range(date('Y') - 70, date('Y') - 0),
                     //'format' => 'dd-MM-yyyy',
                     'widget' => 'single_text',
                     'data' => new \DateTime('now'),

                    'required' => false,
                    
                ])
            ->add('comment', null, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'value' => 'NOCOMMENT',
                ],
                'required' => false,
            ])
            ->add('url', null, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'value' => 'NOURL',
                ],
                'required' => false,
            ])
            ->add('Add', SubmitType::class, [
                'attr' => [
                    'disabled' => true,
                    'class' => 'btn-warning'
                ],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PromoTable::class,
        ]);
    }
}
