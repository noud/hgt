<?php

namespace HGT\AppBundle\Form\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;
use HGT\Application\Catalog\ProductService;
use HGT\Application\Catalog\ProductUnitOfMeasureService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AddToCartForm extends AbstractType
{
    /**
     * @var RequestStack
     */
    private $requestStack;

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
     * @param RequestStack $requestStack
     * @param ProductService $productService
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     */
    public function __construct(RequestStack $requestStack, ProductService $productService, ProductUnitOfMeasureService $productUnitOfMeasureService)
    {
        $this->requestStack = $requestStack;
        $this->productUnitOfMeasureService = $productUnitOfMeasureService;
        $this->productService = $productService;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $product_id = $this->requestStack->getCurrentRequest()->attributes->get('product_id');
        $product = $this->productService->getProductById($product_id);

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
