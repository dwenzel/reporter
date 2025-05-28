<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Config;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ConfigTest extends UnitTestCase
{
    /**
     * @var Config
     */
    protected $subject;

    protected $expectedValue = [
        'platform' =>
            [
                'php' => '7.1',
            ],
    ];

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Initialize MockBundleDescriber test data
        MockBundleDescriber::initializeProperties();

        // Use MockBundleDescriber for testing
        $this->subject = new Config(MockBundleDescriber::class);
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
            Config::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsConfigFromMockClass(): void
    {
        self::assertSame(
            $this->expectedValue,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $expectedJson = json_encode($this->expectedValue);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }
}
