<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class FullPrettyVersion
 */
class FullPrettyVersion extends StringProperty implements PropertyInterface
{
    public const KEY = 'fullPrettyVersion';

    protected static string $key = self::KEY;
}
