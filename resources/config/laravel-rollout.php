<?php

return [
    'storage' => env('ROLLOUT_STORAGE', 'cache'),
    'connection' => env('ROLLOUT_CONNECTION', config('database.default')),
    'table' => env('ROLLOUT_TABLE', 'rollout'),
    'groups' => [],
];
