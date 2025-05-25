<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\StabilityFlags;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class StabilityFlagsTest extends UnitTestCase
{
    /**
     * @var StabilityFlags
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
        $this->subject = new StabilityFlags(MockBundleDescriber::class);
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
            StabilityFlags::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsStabilityFlagsFromMockClass(): void
    {
        $expectedStabilityFlags = [
            'roave/security-advisories' => 20,
        ];

        self::assertSame(
            $expectedStabilityFlags,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $stabilityFlags = [
            'roave/security-advisories' => 20,
        ];

        $expectedJson = json_encode($stabilityFlags);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
