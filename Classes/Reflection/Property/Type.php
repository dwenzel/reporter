<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Type
 */
class Type extends StringProperty implements PropertyInterface
{
    public const KEY = 'type';

    protected static string $key = self::KEY;
}
