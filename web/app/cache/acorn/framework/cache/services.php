<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Bus\\BusServiceProvider',
    1 => 'Illuminate\\Cache\\CacheServiceProvider',
    2 => 'Roots\\Acorn\\Assets\\AssetsServiceProvider',
    3 => 'Roots\\Acorn\\Filesystem\\FilesystemServiceProvider',
    4 => 'Roots\\Acorn\\Providers\\AcornServiceProvider',
    5 => 'Roots\\Acorn\\View\\ViewServiceProvider',
    6 => 'Carbon\\Laravel\\ServiceProvider',
    7 => 'App\\Providers\\ThemeServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Roots\\Acorn\\Assets\\AssetsServiceProvider',
    1 => 'Roots\\Acorn\\Filesystem\\FilesystemServiceProvider',
    2 => 'Roots\\Acorn\\Providers\\AcornServiceProvider',
    3 => 'Roots\\Acorn\\View\\ViewServiceProvider',
    4 => 'Carbon\\Laravel\\ServiceProvider',
    5 => 'App\\Providers\\ThemeServiceProvider',
  ),
  'deferred' => 
  array (
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Bus\\BatchRepository' => 'Illuminate\\Bus\\BusServiceProvider',
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.psr6' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'Illuminate\\Cache\\RateLimiter' => 'Illuminate\\Cache\\CacheServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
  ),
);