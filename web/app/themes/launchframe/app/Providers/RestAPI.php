<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class RestAPI extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register(): void
    {
    }

    /* π ----
    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot(): void
    {
        add_action(
            'rest_api_init',
            [$this, 'launchframe_rest_endpoints']
        );
    }

    public function launchframe_rest_endpoints(): void
    {
    }

    /**
     * @param  mixed  $request
     */
    public function launchframe_projects_callback($request): void
    {
    }

    /**
     * @param  mixed  $request
     */
    public function launchframe_projects_cache_callback($request): void
    {
    }

    /**
     * @param  mixed  $request
     */
    public function launchframe_locations_callback($request): void
    {

    }
}
