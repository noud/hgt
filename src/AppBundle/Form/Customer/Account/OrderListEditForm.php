<?php

namespace HGT\AppBundle\Form\Customer\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderListEditForm extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('products', CollectionType::class, [
            'entry_type' => OrderListEditProductForm::class
        ]);
    }
}
