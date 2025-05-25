<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Description
 */
class Description extends StringProperty implements PropertyInterface
{
    public const KEY = 'description';

    protected static string $key = self::KEY;
}
