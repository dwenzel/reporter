<?php

if (!defined('TYPO3')) {
    die('Access denied');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers'][\DWenzel\Reporter\Routing\Enhancer\ReporterApiEnhancer::REGISTRATION_KEY] = \DWenzel\Reporter\Routing\Enhancer\ReporterApiEnhancer::class;
