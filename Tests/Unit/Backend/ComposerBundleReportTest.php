<?php

namespace DWenzel\Reporter\Tests\Unit\Backend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel
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

use DWenzel\Reporter\Backend\ComposerBundleReport;
use DWenzel\Reporter\Utility\SettingsInterface;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Class ComposerBundleReportTest
 */
class ComposerBundleReportTest extends UnitTestCase
{

    /**
     * @var ComposerBundleReport|MockObject
     */
    protected $subject;

    /**
     * @var ViewInterface|MockObject
     */
    protected $view;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = $this->getMockBuilder(ComposerBundleReport::class)
            ->setMethods(['callStatic'])
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
    public function getPropertiesInstantiatesPropertiesFromClassConstant()
    {
        $properties = $this->subject->getProperties();
        foreach (ComposerBundleReport::PROPERTIES_TO_DISPLAY as $item) {
            $expectedObject = new $item();
            $this->assertContains(
                $expectedObject,
                $properties,
                '',
                false,
                false
            );
        }
    }

    /**
     * @test
     */
    public function getReportInitializesView()
    {
        $this->subject->expects($this->once())
            ->method('callStatic')
            ->with(
                GeneralUtility::class,
                'makeInstance',
                StandaloneView::class
            )
            ->willReturn($this->view);

        $this->view->expects($this->once())
            ->method('setTemplatePathAndFilename');
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
        $expectedVariables = [
            SettingsInterface::PROPERTIES_KEY => $this->subject->getProperties()
        ];

        $this->subject->expects($this->once())
            ->method('callStatic')
            ->willReturn($this->view);

        $this->view->expects($this->once())
            ->method('assignMultiple')
            ->with($expectedVariables);

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
    public function getReportReturnsRenderedView()
    {
        $renderResult = 'foo';

        $this->subject->expects($this->any())
            ->method('callStatic')
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