<?php

namespace App\Form;

use App\Entity\GiftsTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\GiftsUser;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GiftsAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // dd ($options);
        $data = new GiftsTable();
        $data = $options['data'];
        $user = $data->getName();
        // dd($user);
        if ($user == null) {
            $builder
            ->add('name', EntityType::class, [
                'class' => GiftsUser::class,
                'query_builder' => function (EntityRepository $repo) {
                        return $repo->createQueryBuilder('gifts_user')
                        ->orderBy('gifts_user.name', 'ASC');
                },
                'choice_label' => 'name',
                'choice_value' => 'name',
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
                
            ])        ;
               
        } else {
            $builder
            ->add('name', null, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'value' => $user,
                    'readonly' => true,
                ],
                'required' => false,
            ])
            ->add('gift', TextType::class, [
                'attr' => [
                    // 'class' => 'is-valid',
                    'placeholder' => 'Gift *',
                    'oninput'=> 'giftsFormCheckValidity(this)',
                ],
                'required' => true
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
                
            ])        ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiftsTable::class,
        ]);
    }
}
