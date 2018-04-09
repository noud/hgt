<?php

namespace HGT\Application\User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ChangePasswordFormType
 * @package AppBundle\Form
 */
class ChangePasswordFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Huidig wachtwoord',
                'translation_domain' => 'forms',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Nieuw wachtwoord'],
                'second_options' => ['label' => 'Bevestig nieuw wachtwoord'],
                'translation_domain' => 'forms',
            ]);
    }
}
