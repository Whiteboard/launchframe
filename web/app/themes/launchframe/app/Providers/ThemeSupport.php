<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class ThemeSupport extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register(): void
    {
    }

    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot(): void
    {
        add_action('admin_bar_menu', function ($wp_admin_bar) {
            $wp_admin_bar->remove_node('wp-logo');
            $wp_admin_bar->remove_node('comments');
            $wp_admin_bar->remove_node('new-content');
            $wp_admin_bar->remove_node('blog-1-default');

            $my_account = $wp_admin_bar->get_node('my-account');
            $title = str_replace('Howdy,', '', $my_account->title);
            $wp_admin_bar->add_node([
                'id' => 'my-account',
                'title' => $title,
            ]);
        }, 999);

        show_admin_bar(false);

        add_action('admin_menu', function () {
            global $menu;
            $new_acf_label = __('Fields', 'your-textdomain');

            foreach ($menu as $key => $value) {
                if ($value[2] === 'edit.php?post_type=acf-field-group') {
                    $menu[$key][0] = $new_acf_label;
                    break;
                }
            }

            // remove_menu_page('edit.php'); // Hides the Default WP Posts
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

            /* :: Remove Taxonomy Meta Boxes (Using ACF Instead) ------------ */
            // remove_meta_box('tagsdiv', ['article'], 'side');
        });

        /* :: ACF Tweaks
        {+} ---------------------------------- */
        /* :: Clean Up WYSIWYG ------------ */
        add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
            $toolbars['Bard'] = [];
            $toolbars['Bard'][1] = ['formatselect', 'bold', 'italic', 'underline', 'strikethrough', 'bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright', 'blockquote', 'link', 'clear', 'fullscreen'];

            unset($toolbars['Basic']);
            unset($toolbars['Full']);

            return $toolbars;
        });

        /* :: Disable Guttenburg
        {+} ---------------------------------- */
        add_filter('use_block_editor_for_post_type', function () {
            return false;
        });

        add_filter('admin_footer_text', function () {
            echo '<span id="footer-thankyou">Built with ♥ by <a href="https://whiteboard.is" target="_blank">Whiteboard</a></span>';
        });

        add_theme_support('post-formats', []);
        add_theme_support('post-thumbnails');
        add_theme_support('menus');

        // Soil Plugin
        add_action('after_setup_theme', function () {
            add_theme_support('soil', [
                'clean-up', // Cleaner WordPress markup
                'disable-asset-versioning', // Remove asset versioning
                'disable-trackbacks', // Disable trackbacks
                // 'google-analytics' => 'UA-XXXXX-Y', // Google Analytics
                'js-to-footer', // Move JS to footer
                'nav-walker', // Clean up nav menu markup
                'nice-search', // Redirect /?s=query to /search/query
                'relative-urls', // Convert absolute URLs to relative URLs
            ]);
        });

        /* :: People Cleanup
        {+} ---------------------------------- */
        add_filter('manage_edit-person_columns', function ($columns) {
            $columns['title'] = 'Name';

            return $columns;
        });
    }
}
