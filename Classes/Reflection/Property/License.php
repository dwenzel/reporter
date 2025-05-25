<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class License
 */
class License extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'license';

    protected static string $key = self::KEY;
}
