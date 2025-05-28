<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\References;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ReferencesTest extends UnitTestCase
{
    /**
     * @var References
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
        $this->subject = new References(MockBundleDescriber::class);
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
            References::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsReferencesFromMockClass(): void
    {
        $expectedReferences = ['fooRef'];

        self::assertSame(
            $expectedReferences,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $references = ['fooRef'];

        $expectedJson = json_encode($references);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
