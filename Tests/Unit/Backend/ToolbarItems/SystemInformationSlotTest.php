<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Backend\ToolbarItems;

use DWenzel\Reporter\Backend\ToolbarItems\SystemInformationSlot;
use DWenzel\Reporter\Utility\SettingsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class SystemInformationSlotTest extends UnitTestCase
{
    /**
     * @var SystemInformationSlot
     */
    protected $subject;

    /**
     * @var SystemInformationToolbarItem|MockObject
     */
    protected $toolbarItem;

    /**
     * set up subject
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->toolbarItem = $this->getMockBuilder(SystemInformationToolbarItem::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addSystemInformation'])->getMock();
        $this->subject = new SystemInformationSlot();
    }

    /**
     * @test
     */
    public function systemInformationToolbarItemSlotAddsSystemInformation(): void
    {
        $expectedCalls = count($this->subject->getInformationToAdd());
        $this->toolbarItem->expects(self::exactly($expectedCalls))
            ->method('addSystemInformation');
        $this->subject->systemInformationToolbarItemSlot($this->toolbarItem);
    }

    /**
     * @test
     */
    public function getDescriberClassNameInitiallyReturnsAuditorBundleDescriberClass(): void
    {
        $expectedClassName = SystemInformationSlot::DESCRIBER_CLASS_NAME;
        self::assertSame(
            $expectedClassName,
            $this->subject->getDescriberClassName()
        );
    }

    /**
     * @test
     */
    public function constructorOverwritesDescriberClassName(): void
    {
        $customClassName = 'fooBar';

        $this->subject = new SystemInformationSlot($customClassName);
        self::assertSame(
            $customClassName,
            $this->subject->getDescriberClassName()
        );
    }

    /**
     * @test
     */
    public function systemInformationToolbarItemSlotDoesNotAddSystemInformationForInvalidDescriberClassName(): void
    {
        $invalidDescriberClass = 'fooBar';
        $this->subject = new SystemInformationSlot($invalidDescriberClass);
        $this->toolbarItem->expects(self::never())
            ->method('addSystemInformation');
        $this->subject->systemInformationToolbarItemSlot($this->toolbarItem);
    }

    /**
     * @test
     */
    public function systemInformationToolbarItemSlotDoesNotAddSystemInformationForInvalidProperty(): void
    {
        $configurationForInvalidProperty = [
            'Invalid Property' => [
                SettingsInterface::ICON_IDENTIFIER_KEY => 'foo-icon-identifier',
                SettingsInterface::TITLE_KEY => 'bar-title',
            ],
        ];
        $this->subject = $this->getMockBuilder(SystemInformationSlot::class)
            ->onlyMethods(['getInformationToAdd'])
            ->getMock();
        $this->subject->expects(self::once())
            ->method('getInformationToAdd')
            ->willReturn($configurationForInvalidProperty);

        $this->toolbarItem->expects(self::never())
            ->method('addSystemInformation');
        $this->subject->systemInformationToolbarItemSlot($this->toolbarItem);

    }
}
