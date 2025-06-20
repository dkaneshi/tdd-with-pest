<?php

use App\Http\Response;

test('a Response object can be created', function () {
    // Act
    $response = new Response('{"foo": "bar"}', 200);

    // Assert
    expect($response->getStatusCode())
        ->toBeInt()
        ->toBe(200)
        ->and($response->getBody())
        ->toMatchJson(["foo" => "bar"]);
});
