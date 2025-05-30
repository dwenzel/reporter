<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Extra;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ExtraTest extends UnitTestCase
{
    /**
     * @var Extra
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
        $this->subject = new Extra(MockBundleDescriber::class);
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
            Extra::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsExtraFromMockClass(): void
    {
        $expectedExtra = [
            'typo3/cms' => [
                'cms-package-dir' => '{$vendor-dir}/typo3/cms',
                'web-dir' => 'app/web',
            ],
            'helhum/typo3-console' => [
                'install-extension-dummy' => false,
            ],
        ];

        self::assertSame(
            $expectedExtra,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass(): void
    {
        $extra = [
            'typo3/cms' => [
                'cms-package-dir' => '{$vendor-dir}/typo3/cms',
                'web-dir' => 'app/web',
            ],
            'helhum/typo3-console' => [
                'install-extension-dummy' => false,
            ],
        ];

        $expectedJson = json_encode($extra);
        self::assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}
