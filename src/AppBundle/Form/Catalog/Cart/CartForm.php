<?php

namespace HGT\AppBundle\Form\Catalog\Cart;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartForm extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => function (FormInterface $form) {

                $data = $form->getData();

                $groups = array('Default');

                if ($data->form_action === 'update') {
                    $groups[] = 'Update';
                }

                if ($data->form_action === 'finish') {
                    $groups[] = 'Finish';
                }

                return $groups;
            },
        ));
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('form_action', HiddenType::class);

        $builder->add('products', CollectionType::class, [
            'entry_type' => CartProductForm::class
        ]);

        $builder->add('note', TextareaType::class, [
            'label' => false,
        ]);

        $builder->add('delivery_date', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-y',
            'label' => false,
            'html5' => false,
        ]);

        $builder->add('reference', TextType::class, [
            'label' => false,
        ]);
    }
}
