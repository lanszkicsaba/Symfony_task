<?php

namespace App\Form;

use App\Entity\UserTest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

  
class UserTestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Man' => "1",
                    'Female' => "2",
                ], 'expanded' => true,
            ])
            ->add('address', TextType::class)
            ->add('aboutMe', TextareaType::class, ['row_attr' => array('cols' => '5', 'rows' => '5')])
            ->add('isActive', ChoiceType::class,[
                'choices'=>[
                    'Yes'=>true,
                    'No'=>false,
                ],
                'expanded'=>true,
            ])
            ->add('Save', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserTest::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'usertest_item'
        ]);
    }
}
