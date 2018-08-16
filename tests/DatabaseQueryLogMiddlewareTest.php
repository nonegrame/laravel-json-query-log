<?php

namespace Nonegrame\LaravelJsonQueryLog\Test;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nonegrame\LaravelJsonQueryLog\Http\Middleware\DatabaseQueryLogMiddleware;

class DatabaseQueryLogMiddlewareTest extends \Orchestra\Testbench\TestCase
{

    public function test_handle_not_enable()
    {
        // arrange
        config()->set("queryLog.DEBUG_QUERY_ENABLED", false);
        $middleware = $this->createPartialMock(DatabaseQueryLogMiddleware::class, []);
        $request = $this->app->make(Request::class);
        $closure = function () {
            return new JsonResponse();
        };

        // act
        /** @var JsonResponse $response */
        $response = $middleware->handle($request, $closure);
        $responseArray = json_decode($response->getContent(), true);

        // assert
        $this->assertArrayNotHasKey('_query_log', $responseArray);
    }

    public function test_handle_enable()
    {
        // arrange
        config()->set("queryLog.DEBUG_QUERY_ENABLED", true);
        $middleware = $this->createPartialMock(DatabaseQueryLogMiddleware::class, []);
        $request = $this->app->make(Request::class);
        $closure = function () {
            return new JsonResponse();
        };

        // act
        /** @var JsonResponse $response */
        $response = $middleware->handle($request, $closure);
        $responseArray = json_decode($response->getContent(), true);

        // assert
        $this->assertArrayHasKey('_query_log', $responseArray);
    }

    public function test_handle_enable_response_not_json()
    {
        // arrange
        config()->set("queryLog.DEBUG_QUERY_ENABLED", true);
        $middleware = $this->createPartialMock(DatabaseQueryLogMiddleware::class, []);
        $request = $this->app->make(Request::class);
        $closure = function () {
            return new Response("哈哈哈 你看看你");
        };

        // act
        /** @var Response $response */
        $response = $middleware->handle($request, $closure);

        // assert
        $this->assertEquals("哈哈哈 你看看你", $response->getContent());

    }
}