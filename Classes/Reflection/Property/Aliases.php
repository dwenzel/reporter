<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Aliases
 */
class Aliases extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'aliases';

    protected static string $key = self::KEY;
}
