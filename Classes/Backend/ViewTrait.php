<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Backend;

use DWenzel\Reporter\Utility\SettingsInterface as SI;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\View\ViewInterface;

trait ViewTrait
{
    abstract protected function callStatic(string $className, string $methodName, mixed ...$parameters): mixed;

    protected ?ViewInterface $view = null;

    public function injectView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    /**
     * Initializes a StandaloneView with default settings
     */
    protected function initializeStandaloneView(): StandaloneView
    {
        $standaloneView = $this->callStatic(GeneralUtility::class, 'makeInstance', StandaloneView::class);
        $standaloneView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName(SI::TEMPLATE_ROOT_PATH . static::TEMPLATE_PATH)
        );

        return $standaloneView;
    }
}
