<?php

namespace DWenzel\Reporter\Routing\Enhancer;

use DWenzel\Reporter\Configuration\RestApiInterface;
use DWenzel\Reporter\Routing\Compiler\DefaultRestApiRouteCompiler;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Routing\Enhancer\PluginEnhancer;
use TYPO3\CMS\Core\Routing\Route;
use TYPO3\CMS\Core\Routing\RouteCollection;

/***************************************************************
 *  Copyright notice
 *
 *  Copyright (C) 2020 Elias Häußler <e.haeussler@familie-redlich.de>
 *  (c) 2022 Dirk Wenzel <wenzel@cps-it.de>
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
class ReporterApiEnhancer extends PluginEnhancer implements RestApiInterface
{
    public const REGISTRATION_KEY = 'ReporterApiEnhancer';

    protected array $routes = [];
    protected string $apiBasePath = '';
    protected ServerRequestInterface $request;

    public function __construct(array $configuration, ServerRequestInterface $request = null)
    {
        parent::__construct($configuration);
        $this->routes = $this->buildRoutes($configuration[self::KEY_ROUTES] ?? []);
        $this->apiBasePath = '/' . ltrim((string)($configuration['limitToPath'] ?? ''), '/');
        $this->request = $request ?? ServerRequestFactory::fromGlobals();
    }

    protected function buildRoutes(array $routes): array
    {
        $configuredRoutes = [];
        foreach ($routes as $routeConfiguration) {
            if($routeConfiguration[self::ROUTE_OPTION_DEFAULT] ?? false) {
                $defaultRoute = $routeConfiguration;
                continue;
            }

            $configuredRoutes[] = $routeConfiguration;
        }

        if ($defaultRoute !== null) {
            $configuredRoutes[] = $defaultRoute;
        }

        return $configuredRoutes;
    }

    /**
     * @param RouteCollection $collection
     */
    public function enhanceForMatching(RouteCollection $collection): void
    {
        $i = 0;
        /** @var Route $defaultPageRoute */
        $defaultPageRoute = $collection->get('default');
        foreach ($this->routes as $configuration) {
            $route = $this->getVariant($defaultPageRoute, $configuration);
            if ($this->isSuitableVariant($route)) {
                $collection->add($this->namespace . '_' . $i++, $route);
            }
        }
    }

    /**
     * @param Route $defaultPageRoute
     * @param array $configuration
     * @return Route
     */
    protected function getVariant(Route $defaultPageRoute, array $configuration): Route
    {
        // Combine base path with route path
        $routePath = trim(rtrim($this->apiBasePath, '/') . '/' . ltrim($configuration['routePath'], '/'), '/');

        if (!empty($configuration[self::ROUTE_OPTION_DEFAULT])) {
            $routePath = '/' . $this->getDefaultRoutePathPrefix();
        }

        $configuration[self::KEY_ROUTE_PATH] = $routePath;

        // Get request method
        $method = strtoupper((string)($configuration[self::KEY_METHOD] ?? self::METHOD_GET));

        // Build route
        $route = parent::getVariant($defaultPageRoute, $configuration);

        // Set route options
        if ($configuration[self::ROUTE_OPTION_DEFAULT] ?? false) {
            // Set custom compiler class for default route
            // This is necessary to ensure all requests below the API entry point are matched during request
            // and API errors are returned instead of the default page error handling
            $route->setOption('compiler_class', DefaultRestApiRouteCompiler::class);
            $route->setOption( self::ROUTE_OPTION_DEFAULT, true);
        } else {
            // todo geth rid of else part, setMethod?
            $route->setMethods([$method]);
            $route->setOption('target', $configuration['target']);
        }

        return $route;
    }

    /**
     * @param Route $route
     * @return bool
     */
    protected function isSuitableVariant(Route $route): bool
    {
        // Default route is always a suitable variant
        if ($route->getOption(self::ROUTE_OPTION_DEFAULT) ?? false) {
            return true;
        }

        // Only routes matching the current requests' HTTP method are suitable
        $methods = $route->getMethods();
        if (!in_array($this->request->getMethod(), $methods, true)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }


    /**
     * Build relevant static route path prefix of default route.
     *
     * As the default route is used as fallback in cases where no valid route matches, it is quite relevant that
     * its route path matches as much as possible error cases of API requests. Therefore, only static route paths
     * are used to build the default route path. This ensures that all requests below the API entry point are handled.
     *
     * @return string
     */
    protected function getDefaultRoutePathPrefix(): string
    {
        if (!preg_match('/^[^{]+{?/', $this->apiBasePath, $matches) === 1) {
            return '';
        }
        $staticPrefix = $matches[0];
        $pathParts = explode('/', $staticPrefix);
        if (substr($staticPrefix, -1) === '{') {
            $pathParts = array_slice($pathParts, 0, -1);
        }
        return implode('/', array_filter($pathParts));
    }

}
