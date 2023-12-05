<?php

namespace App\Form;

use App\Entity\LegoTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\LegoTheme;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class LegoEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       // dd($options['data']->getTheme());
        // foreach ($options['data'] as $row) {
        //     // dd($row->getName());
        //     array_push($allowedThemes, $row->getName());
        // }
        $selected_theme = $options['data']->getTheme();

        $builder
            ->add('reference', null, [
                'attr' => [
                    'oninput'=> 'legoFormCheckValidity(this)',
                    'type' => 'number',
                ],
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'oninput'=> 'legoFormCheckValidity(this)',
                ],
                'required' => true
            ])
            ->add('theme', EntityType::class, [
                'class' => LegoTheme::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('lego_theme')
                    ->orderBy('lego_theme.name', 'ASC')
                    ;
                },
                'choice_label' => 'name',
                'choice_value' => 'name',
                'choice_attr' => function($theme) use ($selected_theme) {
                    $selected = false;
                    if($theme->getName() == $selected_theme) {
                        $selected = true;
                    }
                    return ['selected' => $selected];
                },
                'placeholder' => false,
                'required' => false

            ])
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
