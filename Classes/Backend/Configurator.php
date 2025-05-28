<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Backend;

use DWenzel\Reporter\Utility\SettingsInterface as SI;

/**
 * Class Configurator
 */
class Configurator
{
    public function registerReports(array $reports): void
    {
        if (empty($reports)) {
            return;
        }

        if (!isset($GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY])) {
            $GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY] = [];
        }
        if (!is_array($GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY])) {
            $GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY] = [];
        }
        $registeredReports = $GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY];
        foreach ($reports as $reportKey => $config) {
            $iconFileName = $config[SI::ICON_KEY];
            $reportClass = $config[SI::CLASS_KEY];

            $reportToRegister = [
                SI::TITLE_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::TITLE_KEY,
                SI::DESCRIPTION_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::DESCRIPTION_KEY,
                SI::ICON_KEY => SI::ICON_PATH . $iconFileName,
                SI::REPORT_KEY => $reportClass,
            ];
            $registeredReports[$reportKey] = $reportToRegister;
        }
        $GLOBALS[SI::TYPO3_CONF_VARS_KEY][SI::SC_OPTIONS_KEY][SI::REPORTS_KEY][SI::EXTENSION_KEY] = $registeredReports;
    }

}
