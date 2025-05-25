<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class MinimumStability
 */
class MinimumStability extends StringProperty implements PropertyInterface
{
    public const KEY = 'minimumStability';

    protected static string $key = self::KEY;
}
