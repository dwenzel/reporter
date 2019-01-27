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
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Class ComposerBundleReportTest
 */
class ComposerBundleReportTest extends UnitTestCase
{

    /**
     * @var ComposerBundleReport
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = new ComposerBundleReport();
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
}