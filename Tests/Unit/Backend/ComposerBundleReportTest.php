<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Tests\Unit\Backend;


use DWenzel\Reporter\Backend\ComposerBundleReport;
use DWenzel\Reporter\Utility\SettingsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Class ComposerBundleReportTest
 */
class ComposerBundleReportTest extends UnitTestCase
{
    protected ComposerBundleReport|MockObject $subject;

    protected ViewInterface|MockObject $view;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(ComposerBundleReport::class)
            ->onlyMethods(['callStatic'])
            ->getMock();

        $this->view = $this->getMockBuilder(StandaloneView::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['assignMultiple', 'setTemplatePathAndFilename', 'render'])
            ->getMock();
    }

    /**
     * @test
     */
    public function viewCanBeInjected(): void
    {
        $view = $this->getMockBuilder(ViewInterface::class)
            ->getMockForAbstractClass();
        $this->subject->injectView($view);
        
        $reflection = new \ReflectionClass($this->subject);
        $viewProperty = $reflection->getProperty('view');
        $viewProperty->setAccessible(true);
        
        self::assertSame($view, $viewProperty->getValue($this->subject));
    }

    /**
     * @test
     */
    public function getPropertiesInstantiatesPropertiesFromClassConstant(): void
    {
        $properties = $this->subject->getProperties();
        self::assertCount(count(ComposerBundleReport::PROPERTIES_TO_DISPLAY), $properties);
        
        foreach ($properties as $property) {
            self::assertInstanceOf(\DWenzel\Reporter\Reflection\Property\PropertyInterface::class, $property);
        }
        
        $propertyClasses = array_map(fn($property) => get_class($property), $properties);
        foreach (ComposerBundleReport::PROPERTIES_TO_DISPLAY as $expectedClass) {
            self::assertContains($expectedClass, $propertyClasses);
        }
    }

    /**
     * @test
     */
    public function getReportInitializesView(): void
    {
        $this->subject->expects(self::once())
            ->method('callStatic')
            ->with(
                GeneralUtility::class,
                'makeInstance',
                StandaloneView::class
            )
            ->willReturn($this->view);

        $this->view->expects(self::once())
            ->method('setTemplatePathAndFilename');
        $this->view->expects(self::once())
            ->method('render')
            ->willReturn('test result');
        $this->subject->getReport();
        
        $reflection = new \ReflectionClass($this->subject);
        $viewProperty = $reflection->getProperty('view');
        $viewProperty->setAccessible(true);
        
        self::assertSame($this->view, $viewProperty->getValue($this->subject));
    }

    /**
     * @test
     */
    public function getReportAssignsVariablesToView(): void
    {
        $expectedVariables = [
            SettingsInterface::PROPERTIES_KEY => $this->subject->getProperties(),
        ];

        $this->subject->expects(self::once())
            ->method('callStatic')
            ->willReturn($this->view);

        $this->view->expects(self::once())
            ->method('assignMultiple')
            ->with($expectedVariables);
        $this->view->expects(self::once())
            ->method('render')
            ->willReturn('test result');

        $this->subject->getReport();
        
        $reflection = new \ReflectionClass($this->subject);
        $viewProperty = $reflection->getProperty('view');
        $viewProperty->setAccessible(true);
        
        self::assertSame($this->view, $viewProperty->getValue($this->subject));
    }

    /**
     * @test
     */
    public function getReportReturnsRenderedView(): void
    {
        $renderResult = 'foo';

        $this->subject->expects(self::any())
            ->method('callStatic')
            ->willReturn($this->view);

        $this->view->expects(self::once())
            ->method('render')
            ->willReturn($renderResult);

        self::assertSame(
            $renderResult,
            $this->subject->getReport()
        );
    }
}
