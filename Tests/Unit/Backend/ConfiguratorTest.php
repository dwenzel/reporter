<?php

namespace CPSIT\Auditor\Tests\Unit\Backend;

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
use DWenzel\Reporter\Backend\Configurator;
use DWenzel\Reporter\Utility\SettingsInterface as SI;
use Nimut\TestingFramework\TestCase\UnitTestCase;

class ConfiguratorTest extends UnitTestCase
{
    /**
     * @var Configurator
     */
    protected $subject;

    /**
     * set up subject
     */
    public function setUp()
    {
        $this->subject = new Configurator();
    }

    /**
     * @test
     */
    public function registerReportsAddsEntryToGlobals()
    {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = [];
        $reportKey = 'foo';
        $reportClass = 'bar\\baz';
        $iconFileName = 'foo.svg';

        $reportsToRegister = [
            $reportKey => [
                SI::ICON_KEY => $iconFileName,
                SI::CLASS_KEY => $reportClass
            ]
        ];
        $expectedConfiguration = [
            'foo' => [
                SI::TITLE_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::TITLE_KEY,
                SI::DESCRIPTION_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::DESCRIPTION_KEY,
                SI::ICON_KEY => SI::ICON_PATH . $iconFileName,
                SI::REPORT_KEY => $reportClass,
            ]
        ];
        $this->subject->registerReports($reportsToRegister);

        $this->assertSame(
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY],
            $expectedConfiguration
        );
    }
    
    /**
     * @test
     */
    public function registerReportsSetsArrayForExtensionKey()
    {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = 'invalid String';
        $reportKey = 'foo';
        $reportClass = 'bar\\baz';
        $iconFileName = 'foo.svg';

        $reportsToRegister = [
            $reportKey => [
                SI::ICON_KEY => $iconFileName,
                SI::CLASS_KEY => $reportClass
            ]
        ];
        $this->subject->registerReports($reportsToRegister);

        $this->assertTrue(
            is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY])
        );
    }

    /**
     * @test
     */
    public function registerReportsDoesNothingForEmptyArgumentReports()
    {
        unset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY]);
        $reports = [];
        $this->subject->registerReports($reports);
        $this->assertEmpty(
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY]
        );
    }
}