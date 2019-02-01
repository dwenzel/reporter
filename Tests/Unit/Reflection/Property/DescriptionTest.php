<?php

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\Description;
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
class DescriptionTest extends UnitTestCase
{
    /**
     * @var Description
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = new Description(MockBundleDescriber::class);
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
            Description::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsDescriptionFromMockClass()
    {
        $expectedDescription = 'A bundle for the project foo-package.';

        $this->assertSame(
            $expectedDescription,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass()
    {
        $description = 'A bundle for the project foo-package.';

        $expectedJson = json_encode($description);
        $this->assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}