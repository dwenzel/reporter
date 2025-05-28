<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

/**
 * Class BooleanProperty
 */
abstract class BooleanProperty
{
    protected static int $type = PropertyInterface::TYPE_BOOLEAN;

    protected ?bool $value = null;
}
