<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function lowercase($string)
    {
        return strtolower($string);
    }

    public function fixTitle($string)
    {
        $separator = '-';
        $quoteSeparator = preg_quote($separator, '#');

        $trans = array(
            '&.+?;'                    => '',
            '[^\w\d _-]'            => '',
            '\s+'                    => $separator,
            '('.$quoteSeparator.')+'=> $separator
        );

        $string = strip_tags($string);
        foreach ($trans as $key => $val){
            $string = preg_replace('#'.$key.'#i', $val, $string);
        }

        $string = strtolower($string);

        return trim(trim($string, $separator));
    }

    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this],
                'locale' => 'nl_NL'
            ]
        );
    }
}
