<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class SourceUrl
 */
class SourceUrl extends StringProperty implements PropertyInterface
{
    public const KEY = 'sourceUrl';

    protected static string $key = self::KEY;
}
