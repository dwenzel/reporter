<?php

namespace DWenzel\Reporter\Tests\Unit\Reflection\Property;

use DWenzel\Reporter\Reflection\Property\PropertyInterface;
use DWenzel\Reporter\Reflection\Property\Repositories;
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
class RepositoriesTest extends UnitTestCase
{
    /**
     * @var Repositories
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = new Repositories(MockBundleDescriber::class);
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
            Repositories::KEY,
            $this->subject->getKey()
        );
    }

    /**
     * @test
     */
    public function getValueReturnsRepositoriesFromMockClass()
    {
        $expectedRepositories = [
            1 => [
                'type' => 'composer',
                'url' => 'https://composer.typo3.org/',
            ],
            'packagist.org' => [
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ],
        ];

        $this->assertSame(
            $expectedRepositories,
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function toJsonReturnsJsonRepresentationFromMockClass()
    {
        $repositories = [
            1 => [
                'type' => 'composer',
                'url' => 'https://composer.typo3.org/',
            ],
            'packagist.org' => [
                'type' => 'composer',
                'url' => 'https?://repo.packagist.org',
                'allow_ssl_downgrade' => true,
            ],
        ];

        $expectedJson = json_encode($repositories);
        $this->assertSame(
            $expectedJson,
            $this->subject->toJson()
        );
    }

}