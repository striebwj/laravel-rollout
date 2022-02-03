<?php

namespace Tests\Console;

use Jaspaul\LaravelRollout\Rollout;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Console\Kernel;
use Jaspaul\LaravelRollout\Drivers\Cache;

class DeleteCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['laravel-rollout.storage' => 'cache']);
    }

    /**
     * @test
     */
    function running_the_command_with_a_feature_will_remove_the_corresponding_feature()
    {
        $store = app()->make('cache.store')->getStore();

        $rollout = app()->make(Rollout::class);
        $rollout->get('derp');

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));

        Artisan::call('rollout:delete', [
            'feature' => 'derp'
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('', $store->get('rollout.feature:__features__'));
    }

    /**
     * @test
     */
    function running_the_command_outputs_a_success_statement()
    {
        Artisan::call('rollout:delete', [
            'feature' => 'derp'
        ]);

        $output = $this->app[Kernel::class]->output();

        $this->assertStringContainsString('derp', $output);
    }
}
