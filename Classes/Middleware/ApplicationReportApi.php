<?php

namespace DWenzel\Reporter\Middleware;

use CPSIT\ApiToken\Context\AuthenticatedAspect;
use DWenzel\ReporterApi\Api;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ApplicationReportApi
 * Handles request for an application report API
 * The request MUST be authenticated beforehand.
 * This middleware only checks, if our API can handle the request and if the
 * @see AuthenticatedAspect  is set in the
 * @see Context
 */
class ApplicationReportApi implements MiddlewareInterface
{
    protected Api $api;
    protected Context $context;

    public function __construct(Api $api = null, Context $context = null)
    {

        $this->api = $api ?? $this->getApiInstance();
        $this->context = $context ?? GeneralUtility::makeInstance(Context::class);
    }

    protected function getApiInstance(): Api
    {
        // not much to do yet
        return new Api();
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->canHandle($request)) {
            return $handler->handle($request);
        }

        return $this->api->process($request, $handler);
    }

    /**
     * Tells if this can handle a request
     *
     * @param ServerRequestInterface $request
     * @return bool
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectPropertyNotFoundException
     */
    protected function canHandle(ServerRequestInterface $request): bool
    {
        if (!($this->api->canHandle($request) && $this->context->hasAspect(AuthenticatedAspect::ASPECT_NAME))
        ) {
            return false;
        }

        $authenticatedAspect = $this->context->getAspect(AuthenticatedAspect::ASPECT_NAME);

        return (bool)$authenticatedAspect->get(AuthenticatedAspect::AUTHENTICATED);
    }
}
