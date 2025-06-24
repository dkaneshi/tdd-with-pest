<?php

declare(strict_types=1);

namespace App\Http;

class Response
{
    const int HTTP_OK = 200;
    const int HTTP_NOT_FOUND = 404;
    const int HTTP_INTERNAL_SERVER_ERROR = 500;
    const int HTTP_BAD_REQUEST = 400;
    const int HTTP_UNAUTHORIZED = 401;
    const int HTTP_FORBIDDEN = 403;
    const int HTTP_METHOD_NOT_ALLOWED = 405;

    public function __construct(
        private readonly string $body = '',
        private readonly int $statusCode = 200,
        private iterable $headers = [],
    )
    {}

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function send(): void
    {
        // Start output buffering
        ob_start();

        // Send headers
        foreach ($this->headers as $key => $value) {
            header("$key: $value");  // e.g. "Content-Type: application/json";
        }

        // This will actually add the content to the buffer
        echo $this->body;

        // Flush the buffer, sending the content to the client
        ob_end_flush();

    }
}