<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\Scripts;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ScriptsTest extends UnitTestCase
{
    /**
     * @var Scripts
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Initialize MockBundleDescriber test data
        MockBundleDescriber::initializeProperties();

        // Use MockBundleDescriber for testing
        $this->subject = new Scripts(MockBundleDescriber::class);
    }

    /**
     * @test
     */
    public function classImplementsPropertyInterface(): void
    {
        self::assertInstanceOf(
            PropertyInterface::class,
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTypeReturnsTypeArray(): void
    {
        self::assertSame(
            PropertyInterface::TYPE_ARRAY,
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function getKeyReturnsClassConstantKey(): void
    {
        self::assertSame(
            Scripts::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsScriptsFromMockClass(): void
    {
        $expectedScripts = [
            'package-states' =>
                [
                    0 => 'php app/vendor/bin/typo3cms install:generatepackagestates',
                ],
            'folder-structure' =>
                [
                    0 => 'php app/vendor/bin/typo3cms install:fixfolderstructure',
                ],
            'pre-deploy' =>
                [
                    0 => '# Scripts here will be executed after composer install',
                ],
            'post-autoload-dump' =>
                [
                    0 => '@package-states',
                    1 => '@folder-structure',
                ],
        ];

        self::assertSame(
            $expectedScripts,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $scripts = [
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
        ];

        $expectedJson = json_encode($scripts);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
