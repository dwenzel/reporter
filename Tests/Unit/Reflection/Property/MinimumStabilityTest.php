<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\MinimumStability;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class MinimumStabilityTest extends UnitTestCase
{
    /**
     * @var MinimumStability
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
        $this->subject = new MinimumStability(MockBundleDescriber::class);
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
            MinimumStability::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsMinimumStabilityFromMockClass(): void
    {
        $expectedMinimumStability = 'stable';

        self::assertSame(
            $expectedMinimumStability,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $minimumStability = 'stable';

        $expectedJson = json_encode($minimumStability);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
