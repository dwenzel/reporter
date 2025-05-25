<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\Repositories;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class RepositoriesTest extends UnitTestCase
{
    /**
     * @var Repositories
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
        $this->subject = new Repositories(MockBundleDescriber::class);
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
            Repositories::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsRepositoriesFromMockClass(): void
    {
        $expectedRepositories = [
            1 => [
                'type' => 'composer',
                'url' => 'https://composer.typo3.org/',
            ],
            'packagist.org' => [
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ],
        ];

        self::assertSame(
            $expectedRepositories,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $repositories = [
            1 => [
                'type' => 'composer',
                'url' => 'https://composer.typo3.org/',
            ],
            'packagist.org' => [
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ],
        ];

        $expectedJson = json_encode($repositories);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
