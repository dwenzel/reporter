<?php


if (!defined('TYPO3')) {
    die ('Access denied');
}

$faIconsToRegister = \DWenzel\Reporter\Utility\SettingsInterface::FA_ICONS_TO_REGISTER;
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

foreach ($faIconsToRegister as $identifier => $name) {
    $iconRegistry->registerIcon(
        $identifier,
        \\FriendsOfTYPO3\FontawesomeProvider\Imaging\IconProvider\FontawesomeIconProvider::class,
        ['name' => $name]
    );
}

// connect slots to signals
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
    \TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem::class,
    'getSystemInformation',
    \DWenzel\Reporter\Backend\ToolbarItems\SystemInformationSlot::class,
    'systemInformationToolbarItemSlot'
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers'][\DWenzel\Reporter\Routing\Enhancer\ReporterApiEnhancer::REGISTRATION_KEY] = \DWenzel\Reporter\Routing\Enhancer\ReporterApiEnhancer::class;

