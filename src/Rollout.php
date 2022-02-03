<?php

namespace Jaspaul\LaravelRollout;

use Opensoft\Rollout\RolloutUserInterface;

class Rollout extends \Opensoft\Rollout\Rollout
{
    public function isActive($feature, RolloutUserInterface $user = null, array $requestParameters = array())
    {
        return parent::isActive($feature, auth()->user() ?? $user, $requestParameters);
    }
}
