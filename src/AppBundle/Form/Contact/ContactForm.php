<?php

namespace HGT\AppBundle\Form\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Naam',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefoon',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mailadres',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Opmerking',
                'required' => true,
                'attr' => [
                    'rows' => '10',
                    'cols' => '10',
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ]);
    }
}
