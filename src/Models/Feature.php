<?php

namespace Jaspaul\LaravelRollout\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    const DB_NAME = 'name';
    const DB_SLUG = 'slug';
    const DB_DESCRIPTION = 'description';
    const DB_CREATED_AT = 'created_at';
    const DB_UPDATED_AT = 'updated_at';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('laravel-rollout.connection'));
        $this->setTable(config('laravel-rollout.table'));
    }

    protected $fillable = [
        self::DB_NAME,
        self::DB_SLUG,
        self::DB_DESCRIPTION,
    ];
}
