<?php

namespace DWenzel\Reporter\Tests\Unit\Fixtures;

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
use CPSIT\Auditor\DescriberTrait;

/**
 * Mock for tests of bundle describer
 * The original class is being generated by the composer plugin cpsit/auditor
 * during installation and update of a project
 *
 * Class MockBundleDescriber
 */
final class MockBundleDescriber implements DescriberInterface
{
    use DescriberTrait;

    static protected $properties = [
        'aliases' => [
            'foo' => 'bar'
        ],
        'minimumStability' => 'stable',
        'stabilityFlags' => [
            'roave/security-advisories' => 20,
        ],
        'references' => [
            'fooRef'
        ],
        'preferStable' => false,
        'config' => [
            'platform' => [
                'php' => '7.1',
            ],
            'vendor-dir' => 'app/vendor',
            'preferred-install' => [
                'dwenzel/foo-package' => 'source',
                'dwenzel/reporter' => 'source',
                '*' => 'dist',
            ],
        ],
        'scripts' => [
            'package-states' => [
                0 => 'php app/vendor/bin/typo3cms install:generatepackagestates',
            ],
            'folder-structure' => [
                0 => 'php app/vendor/bin/typo3cms install:fixfolderstructure',
            ],
            'pre-deploy' => [
                0 => '# Scripts here will be executed after composer install',
            ],
            'post-autoload-dump' => [
                0 => '@package-states',
                1 => '@folder-structure',
            ],
        ],
        'repositories' => [
            1 => [
                'type' => 'composer',
                'url' => 'https://composer.typo3.org/',
            ],
            'packagist.org' => [
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ],
        ],
        'license' => [
            0 => 'GPL-2.0+',
        ],
        'keywords' => ['foo', 'bar', 'keyword'],
        'description' => 'A bundle for the project foo-package.',
        'homepage' => NULL,
        'authors' => [
            0 => [
                'name' => 'Anton Author',
                'role' => 'Developer'
            ]
        ],
        'support' => [],
        'name' => 'dwenzel/foo-bundle',
        'prettyName' => 'dwenzel/foo-bundle',
        'names' => [
            0 => 'dwenzel/foo-bundle',
        ],
        'id' => -1,
        'type' => 'library',
        'targetDir' => NULL,
        'extra' => [
            'typo3/cms' => [
                'cms-package-dir' => '{$vendor-dir}/typo3/cms',
                'web-dir' => 'app/web',
            ],
            'helhum/typo3-console' => [
                'install-extension-dummy' => false,
            ],
        ],
        'installationSource' => NULL,
        'sourceType' => 'fooSourceType',
        'sourceUrl' => 'barSourceUrl',
        'sourceReference' => 'e8eeb29003b19503e92533fdb4a3476ae92ad7a1',
        'sourceMirrors' => NULL,
        'distType' => 'laLaDistType',
        'distUrl' => 'baBaDistUrl',
        'distUrls' => [],
        'distReference' => 'laDist-3e92533fdb4a3476ae92ad7a1',
        'distSha1Checksum' => NULL,
        'distMirrors' => NULL,
        'version' => 'dev-develop',
        'fullPrettyVersion' => 'dev-develop',
        'releaseDate' => NULL,
        'conflicts' => [],
        'provides' => [],
        'replaces' => [],
        'suggests' => [],
        'autoload' => [
            'files' => [
                0 => '/Users/dw/projekt/fgp-typo3/app/vendor/helhum/console-autoload-include.php',
                1 => '/Users/dw/projekt/fgp-typo3/app/vendor/typo3/autoload-include.php',
            ],
        ],
        'devAutoload' => [
            'psr-4' => [
                'DWenzel\\FgpTemplate\\' => 'app/web/typo3conf/ext/fgp_template/Classes',
            ],
        ],
        'includePaths' => [],
        'repository' => NULL,
        'uniqueName' => 'dwenzel/foo-bundle-dev-develop',
        'notificationUrl' => NULL,
    ];

    private function __construct()
    {
    }

}