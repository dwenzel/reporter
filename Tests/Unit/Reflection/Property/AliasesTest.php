<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Aliases;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class AliasesTest extends UnitTestCase
{
    /**
     * @var Aliases
     */
    protected $subject;

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Initialize MockBundleDescriber test data
        MockBundleDescriber::initializeProperties();
        
        // Use MockBundleDescriber for testing
        $this->subject = new Aliases(MockBundleDescriber::class);
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
            Aliases::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsAliasesFromDescriber(): void
    {
        $value = $this->subject->getValue();
        self::assertIsArray($value);
        // Aliases should be an array (empty or with data)
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentation(): void
    {
        $json = $this->subject->toJson();
        self::assertIsString($json);
        self::assertJson($json);
        
        // Verify we can decode it back to the same value
        $decoded = json_decode($json, true);
        self::assertSame($decoded, $this->subject->getValue());
    }

}
