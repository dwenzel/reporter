<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class DistType
 */
class DistType extends StringProperty implements PropertyInterface
{
    public const KEY = 'distType';

    protected static string $key = self::KEY;
}
