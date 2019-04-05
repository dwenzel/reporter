<?php

namespace DWenzel\Reporter\Backend;
use DWenzel\Reporter\Utility\SettingsInterface as SI;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\View\ViewInterface;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel <wenzel@cps-it.de>
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

trait ViewTrait
{
    /**
     * @param string $className Name of the class
     * @param string $methodName Name of the method
     * @return mixed
     */
    abstract protected function callStatic($className, $methodName);

    /**
     * @var StandaloneView
     */
    protected $view;

    public function injectView(ViewInterface $view)
    {
        $this->view = $view;
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
            GeneralUtility::getFileAbsFileName(SI::TEMPLATE_ROOT_PATH . static::TEMPLATE_PATH)
        );

        return $standaloneView;
    }
}
