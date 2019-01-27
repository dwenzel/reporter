<?php

namespace DWenzel\Reporter\Reflection\Property;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel
 *  All rights reserved
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the text file GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CPSIT\Auditor\DescriberInterface;
use CPSIT\Auditor\SettingsInterface as AuditorSI;

/**
 * Trait PropertyTrait
 */
trait PropertyTrait
{
    /**
     * PropertyTrait constructor.
     * @param string $describerClass
     * @throws \Exception
     */
    public function __construct($describerClass = AuditorSI::NAME_SPACE . '\\' . AuditorSI::BUNDLE_DESCRIBER_CLASS)
    {
        if (!class_exists($describerClass)
            || !\in_array(DescriberInterface::class, class_implements($describerClass, true), true)
        ) {
            $message = 'Class ' . $describerClass .  ' not found or does not implement required interface '
                . DescriberInterface::class;
            throw new \Exception($message, 1548611214);
        }

        if ($describerClass::hasProperty(static::$key)) {
            $this->value = $describerClass::getProperty(static::$key);
        }
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::$key;
    }

    /**
     * Get the Json representation of property
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->value);
    }

    /**
     * Get the type
     * @return int
     */
    public function getType(): int
    {
        return static::$type;
    }

    /**
     * @return array|string|int|boolean|null
     */
    public function getValue()
    {
        return $this->value;
    }
}