<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => "user.subscription.form.label.email",
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'user.subscription.form.label.passwordsNotMatch',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                "label" => "",
                'first_options'  => ['label' => 'user.subscription.form.label.password'],
                'second_options' => ['label' => 'user.subscription.form.label.passwordReapeat'],
            ])
            ->add('firstname', TextType::class,[
                "label" => "user.subscription.form.label.firstname",
                'required' => true,
                'attr' => ['class' => 'form-control'],

            ])
            ->add('lastname', TextType::class, [
                "label" => "user.subscription.form.label.lastname",
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add("submit", SubmitType::class, [
                "label" => "user.subscription.button.add",
                'attr' => ['class' => 'btn btn-success mt-2'],
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'Translator'
        ]);
    }
}
