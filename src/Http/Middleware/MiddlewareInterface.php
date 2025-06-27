<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;

interface MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param  Request  $request
     * @param  RequestHandlerInterface  $handler
     * @return Response
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response;

}