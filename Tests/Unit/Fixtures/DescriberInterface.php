<?php

declare(strict_types=1);

namespace CPSIT\Auditor;

/**
 * Stub interface for testing without the auditor dependency
 */
interface DescriberInterface
{
    public static function hasProperty(string $key): bool;
    public static function getProperty(string $key): mixed;
}