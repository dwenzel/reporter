<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\MissingClassException;
use DWenzel\Reporter\MissingInterfaceException;
use DWenzel\Reporter\Reflection\Property\PropertyTrait;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockClassNotImplementingInterface;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class PropertyTraitTest extends UnitTestCase
{
    protected PropertyTrait|MockObject $subject;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(PropertyTrait::class)
            ->disableOriginalConstructor()
            ->getMockForTrait();
    }

    /**
     * @test
     */
    public function constructorThrowsExceptionForMissingClass(): void
    {
        $this->expectException(MissingClassException::class);
        $this->expectExceptionCode(1548611214);
        
        $this->subject->__construct('fooClass');
    }

    /**
     * @test
     */
    public function constructorThrowsExceptionForMissingInterface(): void
    {
        $this->expectException(MissingInterfaceException::class);
        $this->expectExceptionCode(1548611215);
        
        $this->subject->__construct(MockClassNotImplementingInterface::class);
    }
}
