<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\FullPrettyVersion;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class FullPrettyVersionTest extends UnitTestCase
{
    /**
     * @var FullPrettyVersion
     */
    protected $subject;

    protected $expectedValue = 'dev-develop';

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Initialize MockBundleDescriber test data
        MockBundleDescriber::initializeProperties();
        
        // Use MockBundleDescriber for testing
        $this->subject = new FullPrettyVersion(MockBundleDescriber::class);
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
    public function getTypeReturnsTypeString(): void
    {
        self::assertSame(
            PropertyInterface::TYPE_STRING,
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function getKeyReturnsClassConstantKey(): void
    {
        self::assertSame(
            FullPrettyVersion::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsNameFromMockClass(): void
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
