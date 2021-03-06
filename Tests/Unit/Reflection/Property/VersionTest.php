<?php

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Version;
use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Tests\Unit\Fixtures\MockBundleDescriber;
use Nimut\TestingFramework\TestCase\UnitTestCase;


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
class VersionTest extends UnitTestCase
{
    /**
     * @var Version
     */
    protected $subject;

    protected $expectedValue = 'dev-develop';

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = new Version(MockBundleDescriber::class);
    }

    /**
     * @test
     */
    public function classImplementsPropertyInterface()
    {
        $this->assertInstanceOf(
            PropertyInterface::class,
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTypeReturnsTypeString()
    {
        $this->assertSame(
            PropertyInterface::TYPE_STRING,
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function getKeyReturnsClassConstantKey()
    {
        $this->assertSame(
            Version::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsNameFromMockClass()
    {
        $this->assertSame(
            $this->expectedValue,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass()
    {
        $expectedJson = json_encode($this->expectedValue);
        $this->assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}