<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class DistReference
 */
class DistReference extends StringProperty implements PropertyInterface
{
    public const KEY = 'distReference';

    protected static string $key = self::KEY;
}
