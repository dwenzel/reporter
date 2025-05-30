<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class References
 */
class References extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'references';

    protected static string $key = self::KEY;
}
