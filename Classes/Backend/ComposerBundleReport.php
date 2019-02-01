<?php

namespace DWenzel\Reporter\Backend;

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

use DWenzel\Reporter\CallStaticTrait;
use DWenzel\Reporter\Reflection\Property\Aliases;
use DWenzel\Reporter\Reflection\Property\Config;
use DWenzel\Reporter\Reflection\Property\Description;
use DWenzel\Reporter\Reflection\Property\Extra;
use DWenzel\Reporter\Reflection\Property\MinimumStability;
use DWenzel\Reporter\Reflection\Property\Name;
use DWenzel\Reporter\Reflection\Property\PrettyName;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\References;
use DWenzel\Reporter\Reflection\Property\Repositories;
use DWenzel\Reporter\Reflection\Property\Scripts;
use DWenzel\Reporter\Reflection\Property\StabilityFlags;
use DWenzel\Reporter\Utility\SettingsInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Reports\ReportInterface;
use TYPO3Fluid\Fluid\View\ViewInterface;
use DWenzel\Reporter\Utility\SettingsInterface as SI;

/**
 * Class ComposerBundleReport
 *
 * Report about composer bundle (root package) for backend module Reports
 */
class ComposerBundleReport implements ReportInterface
{
    use CallStaticTrait;

    public const PROPERTIES_TO_DISPLAY = [
        Aliases::class,
        Config::class,
        Description::class,
        Extra::class,
        MinimumStability::class,
        Name::class,
        PrettyName::class,
        References::class,
        Repositories::class,
        Scripts::class,
        StabilityFlags::class,
    ];


    /**
     * @var StandaloneView
     */
    protected $view;

    public function injectView(ViewInterface $view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getReport()
    {
        $properties = $this->getProperties();
        $this->view = $this->initializeStandaloneView();

        $this->view->assignMultiple(
            [
                SettingsInterface::PROPERTIES_KEY => $properties
            ]
        );

        return $this->view->render();
    }

    /**
     * Get all properties of the bundle
     *
     * @return array
     */
    public function getProperties(): array
    {
        $properties = [];

        foreach (static::PROPERTIES_TO_DISPLAY as $propertyClass) {
            /** @var PropertyInterface $property */
            $properties[] = new $propertyClass();
        }

        return $properties;
    }

    /**
     * Initializes a StandaloneView with default settings
     *
     * @return StandaloneView
     */
    protected function initializeStandaloneView(): StandaloneView
    {
        /** @var StandaloneView $standaloneView */
        $standaloneView = $this->callStatic(GeneralUtility::class, 'makeInstance', StandaloneView::class);
        $standaloneView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName(SI::TEMPLATE_ROOT_PATH . '/Backend/ComposerBundleReport.html')
        );

        return $standaloneView;
    }
}
