<?php

declare(strict_types=1);

namespace App\Http\Middleware;


use App\Http\Request;
use App\Http\Response;

/**
 * Handles a server request and produces a response.
 *
 * An HTTP request handler process an HTTP request to produce an
 * HTTP response.
 */
interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     *
     * @param  Request  $request
     * @return Response
     */
    public function handle(Request $request): Response;

}