<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Backend;


use CPSIT\Auditor\Reflection\PackageVersions;
use DWenzel\Reporter\Backend\ComposerPackagesReport;
use DWenzel\Reporter\Utility\SettingsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

class ComposerPackagesReportTest extends UnitTestCase
{
    protected ComposerPackagesReport|MockObject $subject;

    protected ViewInterface|MockObject $view;

    protected array $packages = [
        'foo/bar' => '1.0.5@12345',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(ComposerPackagesReport::class)
            ->onlyMethods(['callStatic', 'initializeStandaloneView'])
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
        /** @var ViewInterface|MockObject $view */
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
    public function getReportInitializesView(): void
    {
        $this->subject->expects(self::once())
            ->method('initializeStandaloneView')
            ->willReturn($this->view);
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
        $this->subject->expects(self::once())
            ->method('initializeStandaloneView')
            ->willReturn($this->view);

        $expectedVariables = [
            SettingsInterface::PACKAGES_KEY => $this->packages,
        ];

        $this->subject->expects(self::once())
            ->method('callStatic')
            ->with(PackageVersions::class, 'getAll')
            ->willReturn($this->packages);

        $this->view->expects(self::once())
            ->method('assignMultiple')
            ->with($expectedVariables);
        $this->view->expects(self::once())
            ->method('render')
            ->willReturn('test result');

        $this->subject->getReport();
    }

    /**
     * @test
     */
    public function getReportReturnsRenderedView(): void
    {
        $renderResult = 'foo';

        $this->subject->expects(self::any())
            ->method('initializeStandaloneView')
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
