<?php
declare(strict_types=1);

namespace DWenzel\Reporter\Routing\Compiler;

/*
 * This file is part of the TYPO3 CMS extension "joh_rest".
 *
 * Copyright (C) 2020 Elias Häußler <e.haeussler@familie-redlich.de>
 * Copyright (C) 2022 Dirk Wenzel <d.wenzel@familie-redlich.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

use DWenzel\Reporter\Configuration\RestApiInterface;
use Symfony\Component\Routing\CompiledRoute;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCompiler;

/**
 * DefaultRestApiRouteCompiler
 *
 * @author Elias Häußler <e.haeussler@familie-redlich.de>
 * @license GPL-3.0-or-later
 */
class DefaultRestApiRouteCompiler extends RouteCompiler implements RestApiInterface
{
    public static function compile(Route $route)
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
