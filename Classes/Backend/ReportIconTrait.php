<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Backend;

use DWenzel\Reporter\Utility\SettingsInterface;

/**
 * Trait for handling report icon identifiers
 */
trait ReportIconTrait
{
    /**
     * Get the icon identifier for this report based on its identifier
     */
    public function getIconIdentifier(): string
    {
        $reportIdentifier = $this->getIdentifier();
        
        return SettingsInterface::REPORT_ICON_MAPPING[$reportIdentifier] 
            ?? SettingsInterface::ICON_BUNDLE_IDENTIFIER;
    }
}