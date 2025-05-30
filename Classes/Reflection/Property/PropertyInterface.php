<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

interface PropertyInterface
{
    public const TYPE_ARRAY = 1;
    public const TYPE_BOOLEAN = 2;
    public const TYPE_INTEGER = 3;
    public const TYPE_STRING =  4;

    public function toJson(): string;

    /**
     * Property key in DescriberClass
     */
    public function getKey(): string;

    /**
     * @return int type constant
     */
    public function getType(): int;
}
