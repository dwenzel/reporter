<?php
namespace DWenzel\Reporter\Backend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2018 Dirk Wenzel <wenzel@cps-it.de>
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

use DWenzel\Reporter\Utility\SettingsInterface as SI;
/**
 * Class Configurator
 */
class Configurator
{

    /**
     * @param array $reports
     */
    public function registerReports(array $reports)
    {
        if (empty($reports)) {
            return;
        }

        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY])) {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = [];
        }
        $registeredReports = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY];
        foreach ($reports as $reportKey => $config) {
            $iconFileName = $config[SI::ICON_KEY];
            $reportClass = $config[SI::CLASS_KEY];

            $reportToRegister = [
                SI::TITLE_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::TITLE_KEY,
                SI::DESCRIPTION_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::DESCRIPTION_KEY,
                SI::ICON_KEY => SI::ICON_PATH . $iconFileName,
                SI::REPORT_KEY => $reportClass,
            ];
            $registeredReports[$reportKey] =  $reportToRegister;
        }
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = $registeredReports;
    }

}