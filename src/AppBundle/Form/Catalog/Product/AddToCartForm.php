<?php

namespace HGT\AppBundle\Form\Catalog\Product;

use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\ProductService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddToCartForm extends AbstractType
{
    /**
     * @var ProductUnitOfMeasureService
     */
    private $productUnitOfMeasureService;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * AddToCartForm constructor.
     * @param ProductService $productService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     */
    public function __construct(
        ProductService $productService,
        ProductUnitOfMeasureService $productUnitOfMeasureService
    ) {
        $this->productUnitOfMeasureService = $productUnitOfMeasureService;
        $this->productService = $productService;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Product $product */
        $product = $this->productService->getProductById($options['data']->product);

        $builder->add('form_action', HiddenType::class);

        $builder->add('product_unit_of_measure', EntityType::class, [
            'class' => ProductUnitOfMeasure::class,
            'query_builder' => function () use ($product) {
                return $this->productUnitOfMeasureService->getQueryBuilderForProductUnitOfMeasures($product);
            },
            'required' => true,
            'choice_label' => 'label',
            'choice_attr' => function (ProductUnitOfMeasure $val) {
                return ['data-unit-of-measure-id' => $val->getUnitOfMeasure()->getId()];
            }
        ]);

        $builder->add('qty', TextType::class, [
            'required' => true,
        ]);
    }
}
