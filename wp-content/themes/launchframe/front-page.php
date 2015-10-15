<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */
if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}
$context = Timber::get_context();
$context['post'] = Timber::get_post();
$context['is_home'] = is_home() || is_front_page();
if ($context['is_home']){
  $context['site_css_contents'] = TimberHelper::transient('site_css_contents', function(){
    return file_get_contents(get_template_directory_uri() . "/assets/dist/css/application.min.css");
  }, 14400);
}
$templates = array( 'home.twig' );
Timber::render( $templates, $context );
