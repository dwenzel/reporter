# Reporter

Reporting extension for the TYPO3 CMS that provides additional reporting and auditing capabilities for TYPO3 instances.

## Requirements

* TYPO3 CMS >= 12.4 or >= 13.4
* PHP >= 8.1
* Instance in *Composer Mode*
* `cpsit/auditor` package for auditing functionality
* `cpsit/api-token` package for API authentication
* `dwenzel/reporter-api` package for API endpoints

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

## API Configuration

The Reporter extension provides REST API endpoints for external system integration. Follow these steps to configure and use the API:

### 1. Import API Routes

Add the Reporter API route enhancers to your TYPO3 site configuration file (`config/sites/{site-identifier}/config.yaml`):

```yaml
routeEnhancers:
  ReporterApi:
    type: ReporterApiEnhancer
    limitToPath: '/api/reporter/v{version}'
    namespace: 'rest_api'
    routes:
      - { routePath: '/application/report', method: 'GET', default: true }
    defaults:
      version: '1'
    requirements:
      version: '\d+'
```

### 2. Generate API Token

The Reporter API uses token-based authentication via the `cpsit/api-token` package. Generate tokens using the CLI:

**Interactive Mode:**
```bash
./vendor/bin/typo3 apitoken:generate
```

**Non-Interactive Mode:**
```bash
./vendor/bin/typo3 apitoken:generate \
    --name="Reporter API Token" \
    --description="Authentication for reporter API endpoints" \
    --expires="+6 months" \
    --no-interaction
```

**JSON Output for Automation:**
```bash
./vendor/bin/typo3 apitoken:generate \
    --name="Reporter API Token" \
    --output-format=json \
    --no-interaction
```

**Backend Module:**
1. Navigate to **System** > **API Token Management**
2. Click **Create New Token**
3. Fill in name, description, and expiration
4. **Important:** Copy the secret immediately - it won't be shown again!

### 3. API Usage

#### Available Endpoints

- `GET /api/reporter/v1/application/report` - Retrieve application report data

#### Authentication Headers

All API requests require the following headers:

```http
x-api-identifier: {your-api-identifier}
application-authorization: {your-api-secret}
Content-Type: application/json
```

#### Example Requests

**cURL:**
```bash
curl -X GET "https://your-site.com/api/reporter/v1/application/report" \
     -H "x-api-identifier: 4a6f8b2e3d" \
     -H "application-authorization: 7a5c9f2b-4d8e-1a3c-9e5f-2b4d8e1a3c82" \
     -H "Content-Type: application/json"
```

**HTTP File (for IDE testing):**
```http
GET https://your-site.com/api/reporter/v1/application/report
x-api-identifier: 4a6f8b2e3d
application-authorization: 7a5c9f2b-4d8e-1a3c-9e5f-2b4d8e1a3c82
Content-Type: application/json
```

#### Response Format

The API returns JSON responses with application report data including:
- Bundle information
- Package versions
- Dependency analysis
- System configuration details

### 4. Security Considerations

- **Token Management**: API tokens should be stored securely and rotated regularly
- **Access Control**: Limit API access to authorized systems only
- **HTTPS**: Always use HTTPS in production environments
- **Expiration**: Set appropriate expiration dates for tokens

## Dependencies

- **Core Dependencies**:
  - `typo3/cms-core`: ^12.4 || ^13.4
  - `typo3/cms-reports`: ^12.4 || ^13.4
  - `cpsit/auditor`: ^1.0.0
  - `cpsit/api-token`: For API authentication
  - `dwenzel/reporter-api`: For API endpoints

- **Development Dependencies**:
  - PHPUnit for testing
  - PHP-CS-Fixer for code standards
  - PHPStan for static analysis
  - TYPO3 Rector for code migrations
