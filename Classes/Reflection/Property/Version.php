<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class Version
 */
class Version extends StringProperty implements PropertyInterface
{
    public const KEY = 'version';

    protected static string $key = self::KEY;
}
