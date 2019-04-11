<?php

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Authors;
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
class AuthorsTest extends UnitTestCase
{
    /**
     * @var Authors
     */
    protected $subject;

    protected $expectedValue = [
        0 => [
            'name' => 'Anton Author',
            'role' => 'Developer'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = new Authors(MockBundleDescriber::class);
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
    public function getTypeReturnsTypeArray()
    {
        $this->assertSame(
            PropertyInterface::TYPE_ARRAY,
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function getKeyReturnsClassConstantKey()
    {
        $this->assertSame(
            Authors::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsAuthorsFromMockClass()
    {
        $this->assertSame(
            $this->expectedValue,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function getJsonReturnsJsonRepresentationFromMockClass()
    {
        $expectedJson = json_encode($this->expectedValue);
        $this->assertSame(
            $expectedJson,
            $this->subject->getJson()
        );
    }

}