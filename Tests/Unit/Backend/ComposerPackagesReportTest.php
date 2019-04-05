<?php

namespace CPSIT\Auditor\Tests\Unit\Backend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel <wenzel@cps-it.de>
 *  All rights reserved
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the text file GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CPSIT\Auditor\Reflection\PackageVersions;
use DWenzel\Reporter\Backend\ComposerPackagesReport;
use DWenzel\Reporter\Utility\SettingsInterface;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\View\ViewInterface;


class ComposerPackagesReportTest extends UnitTestCase
{


    /**
     * @var ComposerPackagesReport|MockObject
     */
    protected $subject;

    /**
     * @var ViewInterface|MockObject
     */
    protected $view;

    protected $packages = [
        'foo/bar' => '1.0.5@12345'
    ];

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = $this->getMockBuilder(ComposerPackagesReport::class)
            ->setMethods(['callStatic', 'initializeStandaloneView'])
            ->getMock();

        $this->view = $this->getMockBuilder(StandaloneView::class)
            ->disableOriginalConstructor()
            ->setMethods(['assignMultiple', 'setTemplatePathAndFilename', 'render'])
            ->getMock();
    }

    /**
     * @test
     */
    public function viewCanBeInjected()
    {
        /** @var ViewInterface|MockObject $view */
        $view = $this->getMockBuilder(ViewInterface::class)
            ->getMockForAbstractClass();
        $this->subject->injectView($view);
        $this->assertAttributeSame(
            $view,
            'view',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReportInitializesView()
    {
        $this->subject->expects($this->once())
            ->method('initializeStandaloneView')
            ->willReturn($this->view);

        $this->subject->getReport();
        $this->assertAttributeSame(
            $this->view,
            'view',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReportAssignsVariablesToView()
    {
        $this->subject->expects($this->once())
            ->method('initializeStandaloneView')
            ->willReturn($this->view);

        $expectedVariables = [
            SettingsInterface::PACKAGES_KEY => $this->packages
        ];

        $this->subject->expects($this->once())
            ->method('callStatic')
            ->with(PackageVersions::class, 'getAll')
            ->willReturn($this->packages);

        $this->view->expects($this->once())
            ->method('assignMultiple')
            ->with($expectedVariables);

        $this->subject->getReport();
    }

    /**
     * @test
     */
    public function getReportReturnsRenderedView()
    {
        $renderResult = 'foo';

        $this->subject->expects($this->any())
            ->method('initializeStandaloneView')
            ->willReturn($this->view);

        $this->view->expects($this->once())
            ->method('render')
            ->willReturn($renderResult);

        $this->assertSame(
            $renderResult,
            $this->subject->getReport()
        );
    }
}
