<?php

namespace App\Form;

use App\Entity\LegoTable;
use App\Entity\LegoTheme;
use App\Entity\LegoCondition;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegoAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // dd($options);
        // $allowedThemes = $options['allowed_themes'];
        // $row = new LegoTheme;
        // foreach ($options['data'] as $row) {
        //     // dd($row->getName());
        //     array_push($allowedThemes, $row->getName());
        // }
        // // dd($allowedThemes);

        $builder
            ->add('reference', NumberType::class, [
                'attr' => [
                    'class' => 'has-success',
                    'placeholder' => 'Reference *',
                    'oninput'=> 'myFunction(this.value)',
                ],
                'required' => true
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'placeholder' => 'Name *',
                ],
                'required' => true
            ])
            ->add('theme', EntityType::class, [
                'class' => LegoTheme::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('lego_theme')
                    ->orderBy('lego_theme.name', 'ASC');
                },
                'choice_label' => 'name'
            ])

            ->add('price')
            ->add('date', BirthdayType::class, [
                'years' => range(date('Y') - 70, date('Y') - 0),
                'format' => 'dd-MMMM-yyyy',
                'data' => new \DateTime('now')
                
            ])
            ->add('condition', EntityType::class, [
                'class' => LegoCondition::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('lego_condition')
                    ->orderBy('lego_condition.name', 'ASC');
                },
                'choice_label' => 'name'
            ])
            ->add('url', null, [
                    'attr' => [
                        'readonly' => true,
                    ],
                ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LegoTable::class,
            'allowed_themes' => [],
        ]);
    }
}
