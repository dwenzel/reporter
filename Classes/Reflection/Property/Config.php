<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class Config
 */
class Config extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'config';

    protected static string $key = self::KEY;
}
