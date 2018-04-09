<?php
namespace HGT\AppBundle\Form\User;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class LoginForm
 * @package AppBundle\Form
 */
class LoginForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', null, array(
                'label' => 'Email',
                 'translation_domain' => 'forms',
           ))
            ->add('_password', PasswordType::class, array(
                'label' => 'Password',
                 'translation_domain' => 'forms',
           ))
        ;
    }
}