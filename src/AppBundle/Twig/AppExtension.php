<?php

namespace HGT\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter(
                'price', array($this, 'priceFilter'), array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFilter('phone_href', [$this, 'phoneHref']),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '<span class="euro">&euro;</span> ' . $price;

        return $price;
    }

    public function phoneHref($phoneNumber)
    {
        return 'tel:' . preg_replace('/[^0-9]/', '', $phoneNumber);
    }
}
