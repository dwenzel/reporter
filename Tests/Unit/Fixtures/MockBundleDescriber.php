<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Fixtures;

use CPSIT\Auditor\DescriberInterface;

/**
 * Mock for tests of bundle describer
 * Self-contained mock that provides test data for Property classes
 *
 * Class MockBundleDescriber
 */
final class MockBundleDescriber implements DescriberInterface
{
    protected static $properties;
    
    public static function initializeProperties(): void
    {
        if (self::$properties === null) {
            $data = [
                'aliases' => ['foo' => 'bar'],
                'minimumStability' => 'stable',
                'name' => 'dwenzel/foo-bundle',
                'prettyName' => 'dwenzel/foo-bundle',
                'description' => 'A bundle for the project foo-package.',
                'version' => 'dev-develop',
                'authors' => [['name' => 'Anton Author', 'role' => 'Developer']],
                'keywords' => ['foo', 'bar', 'keyword'],
                'license' => ['GPL-2.0+'],
                'scripts' => [
                    'package-states' => [
                        'php app/vendor/bin/typo3cms install:generatepackagestates',
                    ],
                    'folder-structure' => [
                        'php app/vendor/bin/typo3cms install:fixfolderstructure',
                    ],
                    'pre-deploy' => [
                        '# Scripts here will be executed after composer install',
                    ],
                    'post-autoload-dump' => [
                        '@package-states',
                        '@folder-structure',
                    ],
                ],
                'config' => ['platform' => ['php' => '7.1']],
                'references' => ['fooRef'],
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
                'stabilityFlags' => ['roave/security-advisories' => 20],
                'sourceType' => 'fooSourceType',
                'sourceUrl' => 'barSourceUrl',
                'sourceReference' => 'e8eeb29003b19503e92533fdb4a3476ae92ad7a1',
                'distType' => 'laLaDistType',
                'distUrl' => 'baBaDistUrl',
                'distReference' => 'laDist-3e92533fdb4a3476ae92ad7a1',
                'fullPrettyVersion' => 'dev-develop',
                'extra' => [
                    'typo3/cms' => [
                        'cms-package-dir' => '{$vendor-dir}/typo3/cms',
                        'web-dir' => 'app/web',
                    ],
                    'helhum/typo3-console' => [
                        'install-extension-dummy' => false,
                    ],
                ],
                'type' => 'library',
                'uniqueName' => 'dwenzel/foo-bundle-dev-develop',
            ];
            
            // Properties are expected as serialized string by PropertyTrait
            self::$properties = serialize($data);
        }
    }

    /**
     * Mock method to provide serialized properties like the original PropertiesTrait
     */
    public static function getProperties(): string
    {
        self::initializeProperties();
        return self::$properties;
    }

    /**
     * Interface method implementation
     */
    public static function hasProperty(string $key): bool
    {
        self::initializeProperties();
        $data = unserialize(self::$properties);
        return array_key_exists($key, $data);
    }

    /**
     * Interface method implementation
     */
    public static function getProperty(string $key): mixed
    {
        self::initializeProperties();
        $data = unserialize(self::$properties);
        return $data[$key] ?? null;
    }

    private function __construct() {}

}
