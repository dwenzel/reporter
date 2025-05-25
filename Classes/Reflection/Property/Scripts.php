<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Scripts
 */
class Scripts extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'scripts';

    protected static string $key = self::KEY;
}
