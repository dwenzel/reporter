<?php

declare(strict_types=1);

namespace DWenzel\Reporter\Routing\Compiler;

use DWenzel\Reporter\Configuration\RestApiInterface;
use Symfony\Component\Routing\CompiledRoute;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCompiler;

/**
 * DefaultRestApiRouteCompiler
 */
class DefaultRestApiRouteCompiler extends RouteCompiler implements RestApiInterface
{
    public static function compile(Route $route): CompiledRoute
    {
        $compiledRoute = parent::compile($route);

        // Custom regular expression is only applied to routes defined as default route
        if (!($route->getOption(self::ROUTE_OPTION_DEFAULT) ?? false)) {
            return $compiledRoute;
        }

        return new CompiledRoute(
            $compiledRoute->getStaticPrefix(),
            self::buildRegex($compiledRoute->getRegex()),
            $compiledRoute->getTokens(),
            $compiledRoute->getPathVariables(),
            self::buildRegex($compiledRoute->getHostRegex()),
            $compiledRoute->getHostTokens(),
            $compiledRoute->getHostVariables(),
            $compiledRoute->getVariables()
        );
    }

    /**
     * Build suitable regex for default API route.
     *
     * As the default API route serves as fallback route for several error cases it's quite necessary that it is
     * matched to as many requests as possible which are below the API entry point. To ensure that requests match
     * the default route, the appropriate regular expression for its compiled route is extended. This makes the
     * PageUriMatcher match all relevant requests.
     *
     * @param string|null $regex
     * @return string|null
     */
    protected static function buildRegex(?string $regex): ?string
    {
        if ($regex === null) {
            return null;
        }
        return str_replace('$', '.*$', $regex);
    }
}
