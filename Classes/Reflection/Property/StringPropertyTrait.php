<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Trait StringPropertyTrait
 */
trait StringPropertyTrait
{
    protected static int $type = PropertyInterface::TYPE_STRING;

    protected string $value = '';
}
