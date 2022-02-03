<?php

namespace Tests\Console;

use Jaspaul\LaravelRollout\Rollout;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Jaspaul\LaravelRollout\Helpers\User;

class DeactivateCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['laravel-rollout.storage' => 'cache']);
    }

    /**
     * @test
     */
    function running_the_command_will_deactivate_the_feature_for_all_users()
    {
        $store = app()->make('cache.store')->getStore();

        $rollout = app()->make(Rollout::class);
        $rollout->activateUser('derp', new User("1"));
        $rollout->activatePercentage('derp', 82);

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('82|1|||[]', $store->get('rollout.feature:derp'));

        Artisan::call('rollout:deactivate', [
            'feature' => 'derp'
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('0||||[]', $store->get('rollout.feature:derp'));
    }
}
