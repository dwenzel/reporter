<?php

namespace DWenzel\Reporter\Middleware;

use DWenzel\Reporter\Utility\SettingsInterface;
use DWenzel\ReporterApi\Api;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel <wenzel@cps-it.de>
 *  All rights reserved
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the text file GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class ApplicationReportApi
 * Provides an application report api
 */
class ApplicationReportApi implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $apiInstance = $this->getApiInstance($request, $handler);
        return $apiInstance->process($request, $handler);
    }

    protected function getApiInstance(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        /** @var ConfigurationManagerInterface $configurationManager */
        $configurationManager = GeneralUtility::makeInstance(ObjectManager::class)->get(ConfigurationManager::class);
        $extensionSettings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            SettingsInterface::EXTENSION_KEY
        );

        // read  api key
        $apiKey = 'foo';
        // read secret
        $secret = 'bar';
        $site = $request->getAttribute('siteUrl');
        $attributes = $request->getAttributes();

        // read lang
        $lang = 'en';
        // read config
        $config = [];

        return new Api(
            $apiKey,
            $secret,
            $handler,
            null,
            $lang,
            $config
        );
    }
}
