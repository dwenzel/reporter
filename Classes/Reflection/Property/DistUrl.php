<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class DistUrl
 */
class DistUrl extends StringProperty implements PropertyInterface
{
    public const KEY = 'distUrl';

    protected static string $key = self::KEY;
}
