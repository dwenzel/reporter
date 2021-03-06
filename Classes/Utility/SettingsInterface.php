<?php

namespace DWenzel\Reporter\Utility;

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

use DWenzel\Reporter\Backend\ComposerBundleReport;
use DWenzel\Reporter\Backend\ComposerPackagesReport;

/**
 * Interface SettingsInterface
 */
interface SettingsInterface
{
    public const CLASS_KEY = 'class';
    public const DESCRIPTION_KEY = 'description';
    public const ICON_KEY = 'icon';
    public const TITLE_KEY = 'title';
    public const REPORT_KEY = 'report';
    public const REPORTS_KEY = 'reports';
    public const ICON_IDENTIFIER_KEY = 'icon-identifier';
    public const VERSION_KEY = 'version';
    public const PACKAGE_NAME_KEY = 'prettyName';
    public const PACKAGES_KEY = 'packages';
    public const PROPERTIES_KEY = 'properties';
    public const ICON_BUNDLE_IDENTIFIER = 'reporter-bundle';
    public const ICON_BUNDLE_NAME_IDENTIFIER = 'reporter-bundle-name';
    public const EXTENSION_KEY = 'reporter';
    public const TYPO3_CONF_VARS_KEY = 'TYPO3_CONF_VARS';
    public const SC_OPTIONS_KEY = 'SC_OPTIONS';


    public const RESOURCES_PATH = 'EXT:' . self::EXTENSION_KEY . '/Resources/';
    public const LANGUAGE_FILE_PATH = self::RESOURCES_PATH . 'Private/Language/';
    public const LAYOUT_ROOT_PATH = self::RESOURCES_PATH . 'Private/Layouts';
    public const PARTIAL_ROOT_PATH = self::RESOURCES_PATH . 'Private/Partials';
    public const TEMPLATE_ROOT_PATH = self::RESOURCES_PATH . 'Private/Templates';
    public const TRANSLATION_FILE_REPORTS = 'LLL:' . self::LANGUAGE_FILE_PATH . 'locallang_reports.xlf';
    public const ICON_PATH = self::RESOURCES_PATH . 'Public/Icons/';

    /**
     * Icons to register with
     * \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider
     */
    public const FA_ICONS_TO_REGISTER = [
        self::ICON_BUNDLE_IDENTIFIER => 'th-large',
        self::ICON_BUNDLE_NAME_IDENTIFIER => 'tag'
    ];

    public const REPORTS_TO_REGISTER = [
        'composerBundle' => [
            self::ICON_KEY => 'th-large.svg',
            self::CLASS_KEY => ComposerBundleReport::class
        ],
        'composerPackages' => [
            self::ICON_KEY => 'th-large.svg',
            self::CLASS_KEY => ComposerPackagesReport::class
        ]
    ];
}
