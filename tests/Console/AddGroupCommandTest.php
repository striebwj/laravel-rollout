<?php

namespace Tests\Console;

use Jaspaul\LaravelRollout\Facade\Rollout;
use Tests\TestCase;
use Tests\Doubles\SampleGroup;
use Illuminate\Support\Facades\Artisan;
use Jaspaul\LaravelRollout\Helpers\User;
use Jaspaul\LaravelRollout\Drivers\Cache;

class AddGroupCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['laravel-rollout.storage' => 'cache']);
    }

    /**
     * @test
     */
    public function running_the_command_with_a_feature_will_create_the_corresponding_feature()
    {
        Artisan::call('rollout:add-group', [
            'feature' => 'derp',
            'group' => 'ballers'
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('0||ballers||[]', $store->get('rollout.feature:derp'));
    }

    /**
     * @test
     */
    public function rollout_will_flag_a_user_as_active_if_the_group_returns_true()
    {
        config(['laravel-rollout.groups' => [SampleGroup::class]]);

        $this->assertFalse(Rollout::isActive('derp', new User('id')));

        Artisan::call('rollout:add-group', [
            'feature' => 'derp',
            'group' => 'sample-group'
        ]);

        $this->assertTrue(Rollout::isActive('derp', new User('id')));
    }
}
