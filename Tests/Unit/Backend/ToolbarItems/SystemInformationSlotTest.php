<?php
namespace DWenzel\Reporter\Tests\Unit\Backend\ToolbarItems;
use DWenzel\Reporter\Backend\ToolbarItems\SystemInformationSlot;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;

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

class SystemInformationSlotTest extends UnitTestCase {
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
    public function setUp()
    {
        $this->toolbarItem = $this->getMockBuilder(SystemInformationToolbarItem::class)
            ->disableOriginalConstructor()
            ->setMethods(['addSystemInformation'])->getMock();
        $this->subject = new SystemInformationSlot();
    }


    /**
     * @test
     */
    public function systemInformationToolbarItemSlotAddsSystemInformation()
    {
        $expectedCalls = count($this->subject->getInformationToAdd());
        $this->toolbarItem->expects($this->exactly($expectedCalls))
            ->method('addSystemInformation');
        $this->subject->systemInformationToolbarItemSlot($this->toolbarItem);
    }
}