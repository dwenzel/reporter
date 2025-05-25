<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Trait ArrayPropertyTrait
 */
trait ArrayPropertyTrait
{
    protected static int $type = PropertyInterface::TYPE_ARRAY;

    protected array $value = [];
}
