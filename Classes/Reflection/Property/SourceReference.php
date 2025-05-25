<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class SourceReference
 */
class SourceReference extends StringProperty implements PropertyInterface
{
    public const KEY = 'sourceReference';

    protected static string $key = self::KEY;
}
