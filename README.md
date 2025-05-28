# Reporter

Reporting extension for the TYPO3 CMS that provides additional reporting and auditing capabilities for TYPO3 instances.

## Requirements

* TYPO3 CMS >= 12.4 or >= 13.4
* PHP >= 8.1
* Instance in *Composer Mode*
* `cpsit/auditor` package for auditing functionality

## What does it do

**Reporter** provides comprehensive reporting and auditing capabilities for your TYPO3 instance:

- **System Information Toolbar**: Displays bundle name and version in the TYPO3 backend toolbar
- **Backend Reports Module**: Detailed reports including:
  - Composer bundle information
  - Package dependency analysis
  - Security and compliance auditing
- **REST API Endpoints**: External system integration capabilities
- **Package Analysis**: Extensive reflection system for composer package metadata

## Features

### Backend Integration
- System Information Toolbar integration showing current bundle status
- Dedicated Reports module with comprehensive package information
- Real-time dependency analysis and version tracking

### API Capabilities
- REST API middleware for external integrations
- Custom route compilation and enhancement
- Standardized endpoints for system reporting

### Package Analysis
The extension includes an extensive property reflection system that analyzes:
- Package properties (Name, Version, Description, License, Keywords, etc.)
- Distribution information (URL, Type, Reference)
- Source information (URL, Type, Reference)
- Configuration details (Scripts, Repositories, Extra data)

## Installation

Install via Composer:

```bash
composer require dwenzel/reporter
```

Activate the extension in the TYPO3 Extension Manager or via CLI:

```bash
vendor/bin/typo3 extension:activate reporter
```

## Dependencies

- **Core Dependencies**:
  - `typo3/cms-core`: ^12.4 || ^13.4
  - `typo3/cms-reports`: ^12.4 || ^13.4
  - `cpsit/auditor`: ^1.0.0
  - `dwenzel/reporter-api`: *

- **Development Dependencies**:
  - PHPUnit for testing
  - PHP-CS-Fixer for code standards
  - PHPStan for static analysis
  - TYPO3 Rector for code migrations

## Development

See the development commands in the project's `CLAUDE.md` file for testing, linting, and code quality tools.
