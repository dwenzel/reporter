<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class SourceType
 */
class SourceType extends StringProperty implements PropertyInterface
{
    public const KEY = 'sourceType';

    protected static string $key = self::KEY;
}
