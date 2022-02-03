<?php

namespace Jaspaul\LaravelRollout\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('laravel-rollout.connection'));
        $this->setTable(config('laravel-rollout.table'));
    }

    protected $fillable = [
        'name'
    ];
}
