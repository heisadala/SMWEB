<?php

namespace App\Form;

use App\Entity\GiftsTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\GiftsUser;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class GiftsEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       // dd($options['data']->getTheme());
        // foreach ($options['data'] as $row) {
        //     // dd($row->getName());
        //     array_push($allowedThemes, $row->getName());
        // }
        $selected_name = $options['data']->getName();
        $builder
        ->add('name', EntityType::class, [
            'class' => GiftsUser::class,
            'query_builder' => function (EntityRepository $repo) {
                return $repo->createQueryBuilder('gifts_user')
                ->orderBy('gifts_user.name', 'ASC');
            },
            'choice_label' => 'name',
            'choice_value' => 'name',
            'choice_attr' => function($name) use ($selected_name) {
                $selected = false;
                if($name->getName() == $selected_name) {
                    $selected = true;

                }
                return ['selected' => $selected];
            },
            'placeholder' => false,
            'required' => false

        ])
        ->add('gift', TextType::class, [
            'attr' => [
                // 'class' => 'is-valid',
                'placeholder' => 'Gift *',
                'oninput'=> 'giftsFormCheckValidity(this)',
            ],
            'required' => true
        ])
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
            'data_class' => GiftsTable::class,
            'attr' => [
                'readonly' => false,
            ],
]);
    }
}
