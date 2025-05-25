<?php

declare(strict_types=1);
namespace DWenzel\Reporter\Tests\Unit\Backend;

use DWenzel\Reporter\Backend\Configurator;
use DWenzel\Reporter\Utility\SettingsInterface as SI;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ConfiguratorTest extends UnitTestCase
{
    /**
     * @var Configurator
     */
    protected $subject;

    /**
     * set up subject
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->subject = new Configurator();
    }

    /**
     * @test
     */
    public function registerReportsAddsEntryToGlobals(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = [];
        $reportKey = 'foo';
        $reportClass = 'bar\\baz';
        $iconFileName = 'foo.svg';

        $reportsToRegister = [
            $reportKey => [
                SI::ICON_KEY => $iconFileName,
                SI::CLASS_KEY => $reportClass,
            ],
        ];
        $expectedConfiguration = [
            'foo' => [
                SI::TITLE_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::TITLE_KEY,
                SI::DESCRIPTION_KEY => SI::TRANSLATION_FILE_REPORTS . ':' . $reportKey . '.' . SI::DESCRIPTION_KEY,
                SI::ICON_KEY => SI::ICON_PATH . $iconFileName,
                SI::REPORT_KEY => $reportClass,
            ],
        ];
        $this->subject->registerReports($reportsToRegister);

        self::assertSame(
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY],
            $expectedConfiguration
        );
    }

    /**
     * @test
     */
    public function registerReportsSetsArrayForExtensionKey(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY] = 'invalid String';
        $reportKey = 'foo';
        $reportClass = 'bar\\baz';
        $iconFileName = 'foo.svg';

        $reportsToRegister = [
            $reportKey => [
                SI::ICON_KEY => $iconFileName,
                SI::CLASS_KEY => $reportClass,
            ],
        ];
        $this->subject->registerReports($reportsToRegister);

        self::assertTrue(
            is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY])
        );
    }

    /**
     * @test
     */
    public function registerReportsDoesNothingForEmptyArgumentReports(): void
    {
        unset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY]);
        $reports = [];
        $this->subject->registerReports($reports);
        self::assertEmpty(
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports'][SI::EXTENSION_KEY]
        );
    }
}
