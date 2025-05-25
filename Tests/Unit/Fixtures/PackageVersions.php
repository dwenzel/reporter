<?php

declare(strict_types=1);

namespace CPSIT\Auditor\Reflection;

/**
 * Stub class for testing without the auditor dependency
 */
class PackageVersions
{
    public static function getAll(): array
    {
        return [
            'typo3/cms-core' => '13.4.12',
            'typo3/cms-reports' => '13.4.12',
            'dwenzel/reporter' => 'dev-develop',
        ];
    }
}