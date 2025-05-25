<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class StabilityFlags
 */
class StabilityFlags extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'stabilityFlags';

    protected static string $key = self::KEY;
}
