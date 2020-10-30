<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class Assets extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register()
    {
    }

    /* π ----
    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot()
    {
        add_action('login_enqueue_scripts', function () {
            wp_enqueue_style('admin-styles', self::version('css/admin.css', 'dist'), false);
        });

        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('admin-styles', self::version('css/admin.css', 'dist'), false);
        });

        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('launchframe-styles', self::version('css/site.css', 'dist'), false);
            wp_deregister_script('jquery'); // Bye Felicia!
            wp_enqueue_script('manifest-scripts', self::version('js/manifest.js', 'dist'), array(), false, true);
            wp_enqueue_script('vendor-scripts', self::version('js/vendor.js', 'dist'), array(), false, true);
            wp_enqueue_script('launchframe-scripts', self::version('js/site.js', 'dist'), array(), false, true);
        }, 100);
    }

    /* π ----
    // :: LARAVEL MIX MANIFEST PROCESSING
    // : ---------------------------------- */
    private static function version($path, $manifestDirectory = '')
    {
        static $manifest;

        if (substr($path, 0, 1) !== '/') {
            $path = "/{$path}";
        }

        if ($manifestDirectory && substr($manifestDirectory, 0, 1) !== '/') {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (file_exists(get_stylesheet_directory() . $manifestDirectory . '/hot')) {
            return "http://localhost:8080{$path}";
        }

        if (!$manifest) {
            if (!file_exists($manifestPath = get_stylesheet_directory() . $manifestDirectory . '/mix-manifest.json')) {
                throw new \Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!array_key_exists($path, $manifest)) {
            throw new \Exception(
                "Unable to locate Mix file: {$path}. Please check your " .
                    'webpack.mix.js output paths and try again.'
            );
        }

        return get_template_directory_uri() . $manifestDirectory . $manifest[$path];
    }
}
