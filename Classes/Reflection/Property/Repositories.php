<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;


/**
 * Class Repositories
 */
class Repositories extends ArrayProperty implements PropertyInterface
{
    public const KEY = 'repositories';

    protected static string $key = self::KEY;
}
