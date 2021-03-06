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
    public const DESCRIBER_CLASS_NAME = AuditorSI::NAME_SPACE . '\\' . AuditorSI::BUNDLE_DESCRIBER_CLASS;

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
     * @var string
     */
    protected $describerClass = self::DESCRIBER_CLASS_NAME;

    /**
     * SystemInformationSlot constructor.
     * @param string $describerClassName Class name for bundle describer. Class must implement CPSIT\Auditor\DescriberInterface
     * Pass a custom describer class name in order to replace the default.
     */
    public function __construct(string $describerClassName = null)
    {
        if (null !== $describerClassName) {
            $this->describerClass = $describerClassName;
        }
    }

    /**
     * Slot method for signal SystemInformationToolbarItem
     * @param SystemInformationToolbarItem $item
     */
    public function systemInformationToolbarItemSlot(SystemInformationToolbarItem $item)
    {

        $className = $this->getDescriberClassName();
        if (!class_exists($className)
            || !\in_array(DescriberInterface::class, class_implements($className), true)
        ) {
            return;
        }
        $additionalInformation = $this->getInformationToAdd();
        /** @var DescriberInterface $className */
        foreach ($additionalInformation as $key => $value) {
            if (!$className::hasProperty($key)) {
                continue;
            }
            $property = $className::getProperty($key);
            $title = $value[SI::TITLE_KEY];
            $iconIdentifier = $value[SI::ICON_IDENTIFIER_KEY];
            $item->addSystemInformation(
                $title,
                (string)$property,
                $iconIdentifier
            );
        }
    }

    /**
     * Get the class name for the bundle describer
     */
    public function getDescriberClassName()
    {
        return $this->describerClass;
    }

    /**
     * Get the information to add.
     *
     * @return array An associative array of arrays with key => value pairs
     */
    public function getInformationToAdd()
    {
        return static::$informationToAdd;
    }

}
