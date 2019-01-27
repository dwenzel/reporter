<?php

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;
use DWenzel\Reporter\Reflection\Property\PropertyTrait;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockClassNotImplementingInterface;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;


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
class PropertyTraitTest extends UnitTestCase
{
    /**
     * @var PropertyTrait|MockObject
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = $this->getMockBuilder(PropertyTrait::class)
            ->disableOriginalConstructor()
            ->getMockForTrait();
    }

    /**
     * @test
     * @expectedException \DWenzel\Reporter\MissingClassException
     * @expectedExceptionCode 1548611214
     */
    public function constructorThrowsExceptionForMissingClass() {
        $this->subject->__construct('fooClass');
    }

    /**
     * @test
     * @expectedException \DWenzel\Reporter\MissingInterfaceException
     * @expectedExceptionCode 1548611215
     */
    public function constructorThrowsExceptionForMissingInterface() {
        $this->subject->__construct(MockClassNotImplementingInterface::class);
    }
}