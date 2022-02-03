<?php

return [
    'storage' => env('ROLLOUT_STORAGE', 'database'),
    'connection' => env('ROLLOUT_CONNECTION', config('database.default')),
    'table' => env('ROLLOUT_TABLE', 'rollout'),
    'groups' => [],
];
