<?php

namespace DWenzel\Reporter\Reflection\Property;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

interface PropertyInterface
{
    public const TYPE_ARRAY = 1;
    public const TYPE_BOOLEAN = 2;
    public const TYPE_INTEGER = 3;
    public const TYPE_STRING =  4;

    /**
     * @return string
     */
    public function toJson():string;

    /**
     * Property key in DescriberClass
     *
     * @return string
     */
    public function getKey():string;

    /**
     * @return int type constant
     */
    public function getType():int;
}