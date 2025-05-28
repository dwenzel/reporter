<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Reflection\Property;

use CPSIT\Auditor\DescriberInterface;
use CPSIT\Auditor\SettingsInterface as AuditorSI;
use DWenzel\Reporter\MissingClassException;
use DWenzel\Reporter\MissingInterfaceException;

/**
 * Trait PropertyTrait
 */
trait PropertyTrait
{
    /**
     * @throws MissingClassException
     * @throws MissingInterfaceException
     */
    public function __construct(string $describerClass = AuditorSI::NAME_SPACE . '\\' . AuditorSI::BUNDLE_DESCRIBER_CLASS)
    {
        if (!class_exists($describerClass)) {
            $message = 'Class ' . $describerClass . ' not found';
            throw new MissingClassException($message, 1548611214);
        }
        if (!in_array(DescriberInterface::class, class_implements($describerClass, true) ?: [], true)) {
            $message = 'Class ' . $describerClass . ' does not implement required interface '
                . DescriberInterface::class;
            throw new MissingInterfaceException($message, 1548611215);
        }

        if ($describerClass::hasProperty(static::$key)) {
            $propertyValue = $describerClass::getProperty(static::$key);
            $this->value = $propertyValue ?? $this->getDefaultValue();
        } else {
            $this->value = $this->getDefaultValue();
        }
    }

    public function getKey(): string
    {
        return static::$key;
    }

    /**
     * Get the type
     */
    public function getType(): int
    {
        return static::$type;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Get the Json representation of property
     */
    public function toJson(): string
    {
        return json_encode($this->value, JSON_THROW_ON_ERROR);
    }

    /**
     * Get default value based on property type
     */
    protected function getDefaultValue(): mixed
    {
        return match (static::$type) {
            PropertyInterface::TYPE_ARRAY => [],
            PropertyInterface::TYPE_BOOLEAN => false,
            PropertyInterface::TYPE_INTEGER => 0,
            PropertyInterface::TYPE_STRING => '',
            default => null,
        };
    }
}
