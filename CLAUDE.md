# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the "reporter" TYPO3 CMS extension that provides additional reporting and auditing capabilities for TYPO3 instances. The extension displays bundle information in the System Information Toolbar and provides detailed reports in the TYPO3 backend Reports module.

## Development Commands

### Testing

```bash
# Run all tests
composer test

# Run unit tests only
composer test:unit

# Run functional tests only
composer test:functional

# Run tests with coverage
composer test:coverage
composer test:coverage:unit
composer test:coverage:functional
```

### Code Quality

```bash
# Run all linting checks
composer lint

# Fix all code quality issues
composer fix

# Run specific linters
composer lint:composer     # Validate composer.json
composer lint:editorconfig # Check EditorConfig compliance
composer lint:php          # Check PHP coding standards
composer lint:typoscript   # Check TypoScript coding style

# Fix specific issues
composer fix:composer      # Normalize composer.json
composer fix:editorconfig  # Fix EditorConfig issues
composer fix:php           # Fix PHP coding style with PHP-CS-Fixer

# Static code analysis
composer sca:php           # Run PHPStan analysis
composer phpstan           # Alternative PHPStan command

# Code migration
composer migration:rector  # Run Rector migrations (dry-run)
composer fix:rector        # Apply Rector migrations
```

### CI Commands

```bash
# Run full CI pipeline
composer ci

# Run static analysis only
composer ci:static

# Run dynamic tests only
composer ci:dynamic
```

## Architecture

The extension follows standard TYPO3 extension structure with these key components:

### Core Classes
- **Backend Reports**: `ComposerBundleReport` and `ComposerPackagesReport` provide reporting functionality
- **Configurator**: Central configuration management for the extension
- **ViewTrait**: Shared view functionality across backend components
- **Toolbar Integration**: `SystemInformationSlot` adds bundle info to TYPO3 toolbar

### Reflection System
Extensive property reflection system in `Classes/Reflection/Property/` that analyzes composer package metadata:
- Package properties (Name, Version, Description, License, etc.)
- Distribution information (DistUrl, DistType, DistReference)
- Source information (SourceUrl, SourceType, SourceReference)
- Configuration (Config, Extra, Scripts, Repositories)

### API and Routing
- REST API middleware in `Classes/Middleware/ApplicationReportApi.php`
- Custom route compilation in `Classes/Routing/Compiler/`
- API route enhancement in `Classes/Routing/Enhancer/`

### Dependencies
- Requires TYPO3 v12.4+ or v13.4+
- Uses `cpsit/auditor` for auditing functionality
- Integrates with `dwenzel/reporter-api` for API endpoints
- FontAwesome icons via `friendsoftypo3/fontawesome-provider`

### Test Structure
- Unit tests in `Tests/Unit/` with PHPUnit configuration in `Tests/Build/UnitTests.xml`
- Comprehensive property reflection tests
- Backend component testing with mocks in `Tests/Unit/Fixtures/`

The extension provides both backend UI components and API endpoints for external system integration.