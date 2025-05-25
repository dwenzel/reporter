<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Backend;

use CPSIT\Auditor\Reflection\PackageVersions;
use DWenzel\Reporter\CallStaticTrait;
use DWenzel\Reporter\Utility\SettingsInterface;


use TYPO3\CMS\Reports\ReportInterface;

/**
 * Class ComposerPackagesReport
 */
class ComposerPackagesReport implements ReportInterface
{
    use CallStaticTrait;
    use ViewTrait;
    use ReportIconTrait;
    public const TEMPLATE_PATH = '/Backend/ComposerPackagesReport.html';

    public function getReport(): string
    {
        $packages = $this->callStatic(PackageVersions::class, 'getAll');
        $this->view = $this->initializeStandaloneView();

        $this->view->assignMultiple(
            [
                SettingsInterface::PACKAGES_KEY => $packages,
            ]
        );

        return $this->view->render();
    }

    public function getIdentifier(): string
    {
        return 'composer-packages-report';
    }

    public function getTitle(): string
    {
        return 'Composer Packages Report';
    }

    public function getDescription(): string
    {
        return 'Report showing all installed composer packages';
    }

}
