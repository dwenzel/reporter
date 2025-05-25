<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Authors
 */
class Authors extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'authors';

    protected static string $key = self::KEY;
}
