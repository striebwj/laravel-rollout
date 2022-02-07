<?php

namespace Jaspaul\LaravelRollout\Drivers;

use Illuminate\Support\Facades\DB;
use Jaspaul\LaravelRollout\Models\Feature;
use Opensoft\Rollout\Storage\StorageInterface;

class Database implements StorageInterface
{

    /**
     * @var \Illuminate\Database\Query\Builder
     */
    private $dbQuery;

    public function __construct()
    {
        $this->dbQuery = DB::connection(config('laravel-rollout.connection'))->table(config('laravel-rollout.table'));
    }


    /**
     * @inheritDoc
     */
    public function get($key)
    {
        return $this->dbQuery->where(Feature::DB_SLUG, $key)->first();
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value)
    {
        // TODO: Implement set() method.
    }

    /**
     * @inheritDoc
     */
    public function remove($key)
    {
        // TODO: Implement remove() method.
    }
}
