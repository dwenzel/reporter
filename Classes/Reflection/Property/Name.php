<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Name
 */
class Name extends StringProperty implements PropertyInterface
{
    public const KEY = 'name';

    protected static string $key = self::KEY;
}
