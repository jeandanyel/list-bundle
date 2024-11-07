<?php

namespace Jeandanyel\ListBundle\Helper;

class StringHelper {
    public static function snakeToCamel(string $string): string
    {
        return str_replace(' ', '', lcfirst(ucwords(str_replace('_', ' ', $string))));
    }
}