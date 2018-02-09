<?php

namespace AppBundle\Form\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('account_username', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Gebruikersnaam',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])
            ->add('account_password', PasswordType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Wachtwoord',
                    'autocomplete' => 'new-password',
                    'autocorrect' => 'off'
                ]
            ])
        ;
    }
}
