<?php

namespace DWenzel\Reporter\Backend;
use DWenzel\Reporter\CallStaticTrait;
use DWenzel\Reporter\Utility\SettingsInterface;
use TYPO3\CMS\Reports\ReportInterface;

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

use CPSIT\Auditor\Reflection\PackageVersions;

/**
 * Class ComposerPackagesReport
 */
class ComposerPackagesReport implements ReportInterface
{
    public const TEMPLATE_PATH = '/Backend/ComposerPackagesReport.html';
    use CallStaticTrait, ViewTrait;

    /**
     * @return string
     */
    public function getReport()
    {
        $packages = $this->callStatic(PackageVersions::class, 'getAll');
        $this->view = $this->initializeStandaloneView();

        $this->view->assignMultiple(
            [
                SettingsInterface::PACKAGES_KEY => $packages
            ]
        );

        return $this->view->render();
    }


}
