<?php

declare(strict_types=1);

/*
 * This file is part of the reporter Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
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

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'reporter-bundle' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:reporter/Resources/Public/Icons/table-cells-large.svg',
    ],
    'reporter-bundle-name' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:reporter/Resources/Public/Icons/tag.svg',
    ],
    'extension-reporter' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:reporter/Resources/Public/Icons/th-large.svg',
    ],
];