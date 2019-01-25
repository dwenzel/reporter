<?php

namespace DWenzel\Reporter\Backend\ToolbarItems;

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
use DWenzel\Reporter\Utility\SettingsInterface as SI;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;

/**
 * Class SystemInformationSlot
 */
class SystemInformationSlot
{
    static protected $informationToAdd = [
        SI::PACKAGE_NAME_KEY => [
            SI::ICON_IDENTIFIER_KEY => SI::ICON_BUNDLE_IDENTIFIER,
            SI::TITLE_KEY => 'Bundle Name'
        ],
        SI::VERSION_KEY => [
            SI::ICON_IDENTIFIER_KEY => SI::ICON_BUNDLE_NAME_IDENTIFIER,
            SI::TITLE_KEY => 'Bundle Version',
        ]
    ];

    /**
     * Get the information to add.
     *
     * @return array An associative array of arrays with key => value pairs
     */
    public function getInformationToAdd()
    {
        return static::$informationToAdd;
    }

    /**
     * Slot method for signal SystemInformationToolbarItem
     * @param SystemInformationToolbarItem $item
     */
    public function systemInformationToolbarItemSlot(SystemInformationToolbarItem $item) {

        $describerClass = AuditorSI::NAME_SPACE . '\\' . AuditorSI::BUNDLE_DESCRIBER_CLASS;
        if (!class_exists($describerClass)
        || !\in_array(DescriberInterface::class, class_implements($describerClass), true)
        ) {
            return;
        }
        /** @var DescriberInterface $describerClass */
        foreach (static::$informationToAdd as $key => $value) {
            if (!$describerClass::hasProperty($key)) {
                continue;
            }
            $property = $describerClass::getProperty($key);
            $title = $value[SI::TITLE_KEY];
            $iconIdentifier = $value[SI::ICON_IDENTIFIER_KEY];
            $item->addSystemInformation(
                $title,
                (string)$property,
                $iconIdentifier
            );
        }
    }

}
