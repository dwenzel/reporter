<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Keywords
 */
class Keywords extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'keywords';

    protected static string $key = self::KEY;
}
