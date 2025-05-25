<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class UniqueName
 */
class UniqueName extends StringProperty implements PropertyInterface
{
    public const KEY = 'uniqueName';

    protected static string $key = self::KEY;
}
