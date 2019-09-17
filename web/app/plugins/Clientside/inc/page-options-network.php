<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<?php Clientside_Pages::show_page_tabs( $page_info['slug'], true ); ?>

	<div class="clientside-page-sidebar clientside-page-sidebar--lower">
		<div class="clientside-widget clientside-widget-empty">
			<input type="submit" class="button-primary clientside-button-action clientside-button-large clientside-button-w100p" data-js-relay=".clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
			<button class="button-secondary clientside-options-revert-button clientside-button-large clientside-button-w100p"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
		</div>
		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">
				<p>
					Note that these are only network-related options. To manage site specific options, visit the network sites individually.
				</p>
			</div>
		</div>
	</div>

	<?php settings_errors(); ?>

	<form method="post" action="edit.php?action=<?php echo esc_attr( Clientside_Options::$options_slug ); ?>" class="clientside-page-content clientside-options-form">

		<input type="hidden" name="<?php echo esc_attr( Clientside_Options::$options_slug ); ?>[<?php echo 'options-page-identification'; ?>]" value="<?php echo esc_attr( $page_info['slug'] ); ?>">

		<?php // Prepare options ?>
		<?php settings_fields( Clientside_Options::$options_slug ); ?>

		<?php // Show this page's option sections & fields ?>
		<?php do_settings_sections( $page_info['slug'] ); ?>

		<p class="submit">
			<input type="submit" name="submit" class="button-primary clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
		</p>

	</form>

</div>
