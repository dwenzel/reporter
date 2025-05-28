<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class Extra
 */
class Extra extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'extra';

    protected static string $key = self::KEY;
}
