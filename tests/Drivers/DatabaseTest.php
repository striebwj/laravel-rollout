<?php

namespace Tests\Drivers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Jaspaul\LaravelRollout\Drivers\Database;
use Jaspaul\LaravelRollout\Facade\Rollout;
use Jaspaul\LaravelRollout\Models\Feature;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['laravel-rollout.storage' => 'database']);
    }

    /**
     * @test
     */
    public function it_can_connect_to_the_database()
    {
        $featureSlug = 'test-feature';
        $feature = factory(Feature::class)->create([
            Feature::DB_SLUG => $featureSlug,
        ]);

        $rollout = new \Jaspaul\LaravelRollout\Rollout($this->app->make(Database::class));

        dd($rollout->isActive($featureSlug));

        $this->assertTrue(true);
    }
}
