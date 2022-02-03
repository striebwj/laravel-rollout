<?php

namespace Tests\Http;

use Illuminate\Auth\Access\AuthorizationException;
use Jaspaul\LaravelRollout\Facade\Rollout;
use Jaspaul\LaravelRollout\Helpers\User;
use Jaspaul\LaravelRollout\Http\Middleware\RolloutMiddleware;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('rollout.storage', 'cache');
    }

    /**
     * @test
     */
    function rollout_middleware_will_prevent_access_to_disabled_features()
    {
        $this->expectException(AuthorizationException::class);

        $middleware = new RolloutMiddleware();

        $http = $this->createMock(\Illuminate\Http\Request::class);

        $middleware->handle($http, function () {
            return 'foo';
        }, 'test-feature');
    }

    /**
     * @test
     */
    function rollout_middleware_will_allow_access_to_enabled_features()
    {
        $middleware = new RolloutMiddleware();

        $http = $this->createMock(\Illuminate\Http\Request::class);

        Rollout::activate('test-feature');

        $next = $middleware->handle($http, function () {
            return 'foo';
        }, 'test-feature');


        $this->assertEquals('foo', $next);
    }

    /**
     * @test
     */
    function rollout_middleware_will_prevent_access_if_all_features_are_not_active()
    {
        $this->expectException(AuthorizationException::class);

        $middleware = new RolloutMiddleware();

        $http = $this->createMock(\Illuminate\Http\Request::class);

        Rollout::activate('test-feature');

        $middleware->handle($http, function () {
            return 'foo';
        }, 'test-feature', 'test-feature-2');
    }

    /**
     * @test
     */
    function rollout_middleware_will_all_access_if_all_features_are_active()
    {
        $middleware = new RolloutMiddleware();

        $http = $this->createMock(\Illuminate\Http\Request::class);

        Rollout::activate('test-feature');
        Rollout::activate('test-feature-2');

        $next = $middleware->handle($http, function () {
            return 'foo';
        }, 'test-feature', 'test-feature-2');


        $this->assertEquals('foo', $next);
    }

}
