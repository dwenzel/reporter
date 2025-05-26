<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Backend\ToolbarItems;


use CPSIT\Auditor\DescriberInterface;
use CPSIT\Auditor\SettingsInterface as AuditorSI;
use DWenzel\Reporter\Utility\SettingsInterface as SI;
use TYPO3\CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent;

/**
 * Event listener for adding bundle information to the System Information Toolbar
 */
class SystemInformationSlot
{
    public const DESCRIBER_CLASS_NAME = AuditorSI::NAME_SPACE . '\\' . AuditorSI::BUNDLE_DESCRIBER_CLASS;

    protected static array $informationToAdd = [
        SI::PACKAGE_NAME_KEY => [
            SI::ICON_IDENTIFIER_KEY => SI::ICON_BUNDLE_IDENTIFIER,
            SI::TITLE_KEY => 'Bundle Name',
        ],
        SI::VERSION_KEY => [
            SI::ICON_IDENTIFIER_KEY => SI::ICON_BUNDLE_NAME_IDENTIFIER,
            SI::TITLE_KEY => 'Bundle Version',
        ],
    ];

    protected string $describerClass = self::DESCRIBER_CLASS_NAME;

    /**
     * @param string|null $describerClassName Class name for bundle describer. Class must implement CPSIT\Auditor\DescriberInterface
     */
    public function __construct(?string $describerClassName = null)
    {
        if ($describerClassName !== null) {
            $this->describerClass = $describerClassName;
        }
    }

    /**
     * PSR-14 Event listener for SystemInformationToolbarCollectorEvent
     */
    public function __invoke(SystemInformationToolbarCollectorEvent $event): void
    {
        $item = $event->getToolbarItem();
        
        $className = $this->getDescriberClassName();
        if (!class_exists($className)
            || !in_array(DescriberInterface::class, class_implements($className) ?: [], true)
        ) {
            return;
        }
        $additionalInformation = $this->getInformationToAdd();
        /** @var DescriberInterface $className */
        foreach ($additionalInformation as $key => $value) {
            if (!$className::hasProperty($key)) {
                continue;
            }
            $property = $className::getProperty($key);
            $title = $value[SI::TITLE_KEY];
            $iconIdentifier = $value[SI::ICON_IDENTIFIER_KEY];
            $item->addSystemInformation(
                $title,
                (string)$property,
                $iconIdentifier
            );
        }
    }

    /**
     * Get the class name for the bundle describer
     */
    public function getDescriberClassName(): string
    {
        return $this->describerClass;
    }

    /**
     * Get the information to add.
     *
     * @return array<string, array<string, string>> An associative array of arrays with key => value pairs
     */
    public function getInformationToAdd(): array
    {
        return static::$informationToAdd;
    }

}
