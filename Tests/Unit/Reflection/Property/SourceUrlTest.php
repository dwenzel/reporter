<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\SourceUrl;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class SourceUrlTest extends UnitTestCase
{
    /**
     * @var SourceUrl
     */
    protected $subject;

    protected $expectedValue = 'barSourceUrl';

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Initialize MockBundleDescriber test data
        MockBundleDescriber::initializeProperties();
        
        // Use MockBundleDescriber for testing
        $this->subject = new SourceUrl(MockBundleDescriber::class);
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
            SourceUrl::KEY,
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
