<?php

return [
    /* :: Current Environment
    {+} ---------------------------------- */
    'environment' => getenv('WP_ENV'),

    /* :: Debug Mode
    {+} ---------------------------------- */
    'debug' => WP_DEBUG ?? false,

    /* :: List of providers to initialize during app boot
    {+} ---------------------------------- */
    'providers' => [
        Rareloop\Lumberjack\Providers\RouterServiceProvider::class,
        Rareloop\Lumberjack\Providers\WordPressControllersServiceProvider::class,
        Rareloop\Lumberjack\Providers\TimberServiceProvider::class,
        Rareloop\Lumberjack\Providers\ImageSizesServiceProvider::class,
        Rareloop\Lumberjack\Providers\CustomPostTypesServiceProvider::class,
        Rareloop\Lumberjack\Providers\MenusServiceProvider::class,
        Rareloop\Lumberjack\Providers\LogServiceProvider::class,
        Rareloop\Lumberjack\Providers\ThemeSupportServiceProvider::class,
        Rareloop\Lumberjack\Providers\QueryBuilderServiceProvider::class,
        Rareloop\Lumberjack\Providers\SessionServiceProvider::class,
        Rareloop\Lumberjack\Providers\EncryptionServiceProvider::class,

        /* :: Application Providers ------------ */
        App\Providers\ThemeSupport::class,
        App\Providers\Globals::class,
        App\Providers\Assets::class
    ],

    'aliases' => [
        'Config' => Rareloop\Lumberjack\Facades\Config::class,
        'Log' => Rareloop\Lumberjack\Facades\Log::class,
        'Router' => Rareloop\Lumberjack\Facades\Router::class,
        'Session' => Rareloop\Lumberjack\Facades\Session::class,
    ],

    'logs' => [
        'enabled' => true,
        'path' => false,
        'level' => Monolog\Logger::ERROR,
    ],

    'themeSupport' => [
        'post-thumbnails',
    ],

    /**
     * The key used by the Encrypter. This should be a random 32 character string.
     */
    'key' => getenv('APP_KEY'),
];
