<?php

namespace Jaspaul\LaravelRollout\Facade;

use Illuminate\Support\Facades\Facade;

class Rollout extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
//        return app(\Opensoft\Rollout\Rollout::class);
        return app(\Jaspaul\LaravelRollout\Rollout::class);
    }
}
