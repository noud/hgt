<?php

namespace HGT\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    /**
     * @return array|\Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('phone_href', [$this, 'phoneHref']),
        );
    }

    /**
     * @param $number
     * @param int $decimals
     * @param string $decPoint
     * @param string $thousandsSep
     * @return string
     */
    public function priceFilter($number, $decimals = 2, $decPoint = ',', $thousandsSep = '.')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '<span class="euro">&euro;</span> ' . $price;

        return $price;
    }

    /**
     * @param $phoneNumber
     * @return string
     */
    public function phoneHref($phoneNumber)
    {
        return 'tel:' . preg_replace('/[^0-9]/', '', $phoneNumber);
    }
}
