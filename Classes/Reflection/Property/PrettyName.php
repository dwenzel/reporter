<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class PrettyName
 */
class PrettyName extends StringProperty implements PropertyInterface
{
    public const KEY = 'prettyName';

    protected static string $key = self::KEY;
}
