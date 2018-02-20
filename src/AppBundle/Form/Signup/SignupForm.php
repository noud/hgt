<?php

namespace HGT\AppBundle\Form\Signup;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SignupForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, [
                'label' => 'Bedrijfsnaam',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('companyNumber', TextType::class, [
                'label' => 'KVK nummer',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('gender', ChoiceType::class, [
                'label' => false,
                'placeholder' => null,
                'choices'  => [
                    'Dhr.' => 'Dhr.',
                    'Mevr.' => 'Mevr.'
                    ],
                'multiple' => false,
                'expanded' => true,
                'required' => false
                ])

            ->add('contactPerson', TextType::class, [
                'label' => 'Contactpersoon',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('phone', TextType::class, [
                'label' => 'Telefoonnummer',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('mobile', TextType::class, [
                'label' => 'Mobiel',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('address', TextType::class, [
                'label' => 'Adres',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('postal', TextType::class, [
                'label' => 'Postcode',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                    'autocomplete' => 'nofill',
                    'autocorrect' => 'off'
                ]
            ])

            ->add('place', TextType::class, [
                'label' => 'Plaats',
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
            ->add('profit', CheckboxType::class, [
                'label' => 'Ja, ik profiteer graag van alle voordelen en acties en schrijf me in voor de Horeca Groothandel Tilburg nieuwsbrief',
                'required' => false,
            ])

        ;
    }
}
