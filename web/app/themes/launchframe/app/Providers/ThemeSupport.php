<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use App\Providers\Admin;

class ThemeSupport extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register()
    {
    }

    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot()
    {
        add_action('admin_bar_menu', function ($wp_admin_bar) {
            $wp_admin_bar->remove_node('wp-logo');
            $wp_admin_bar->remove_node('comments');
            $wp_admin_bar->remove_node('new-content');
            $wp_admin_bar->remove_node('blog-1-default');

            $my_account = $wp_admin_bar->get_node('my-account');
            $title = str_replace('Howdy,', '', $my_account->title);
            $wp_admin_bar->add_node(array(
                'id' => 'my-account',
                'title' => $title,
            ));
        }, 999);

        show_admin_bar(false);

        add_action('admin_menu', function () {
            remove_menu_page('edit.php');
            remove_menu_page('edit-comments.php');
            remove_menu_page('jetpack');

            remove_submenu_page('themes.php', 'themes.php');
        });

        add_action('admin_init', function () {
            remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
            remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
            remove_meta_box('dashboard_primary', 'dashboard', 'normal');
            remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
            remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
            remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
            remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        });

        /* :: Disable Guttenburg
        {+} ---------------------------------- */
        add_filter("use_block_editor_for_post_type", function () {
            return false;
        });

        add_filter('admin_footer_text', function () {
            echo '<span id="footer-thankyou">Built with ♥ by <a href="https://whiteboard.is" target="_blank">Whiteboard</a></span>';
        });

        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');

        // Roots.io Soil plugin
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-js-to-footer');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');
    }
}
