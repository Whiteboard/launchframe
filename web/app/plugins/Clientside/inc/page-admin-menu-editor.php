<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<div class="clientside-page-sidebar">

		<div class="clientside-widget clientside-widget-empty">
			<input type="submit" class="button-primary clientside-button-action clientside-button-large clientside-button-w100p" data-js-relay=".clientside-admin-menu-save-button" value="<?php _e( 'Save Settings' ); ?>">
			<?php if ( ! is_multisite() || is_super_admin() ) { ?>
				<button class="button-secondary clientside-admin-menu-revert-button clientside-button-large clientside-button-w100p"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
			<?php } ?>
		</div>

		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">
				<p>
					<?php _e( 'For instructions on using this tool, visit the Clientside Documentation pages:', 'clientside' ); ?>
				</p>
				<p>
					<a class="clientside-button-lined clientside-button-large clientside-button-w100p" href="<?php echo Clientside_Pages::get_page_url( 'clientside-documentation' ); ?>"><?php _e( 'Documentation', 'clientside' ); ?></a>
				</p>
			</div>
		</div>

		<a class="clientside-widget clientside-widget-empty clientside-button-lined clientside-button-large clientside-button-w100p" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>"><?php _e( 'All Clientside Tools', 'clientside' ); ?></a>
	</div>

	<div class="clientside-page-content">

		<?php settings_errors(); ?>

		<?php // Output actual admin menu editor HTML ?>
		<?php Clientside_Admin_Menu_Editor::print_menu_editor(); ?>

		<?php // Output the settings form to save the customized menu in ?>
		<form method="post" action="options.php" class="clientside-admin-menu-editor-form">

			<input type="hidden" name="<?php echo Clientside_Options::$options_slug; ?>[<?php echo 'options-page-identification'; ?>]" value="<?php echo $page_info['slug']; ?>">

			<?php // Prepare options ?>
			<?php settings_fields( Clientside_Options::$options_slug ); ?>

			<?php // Show this page's option sections & fields ?>
			<?php do_settings_sections( $page_info['slug'] ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary clientside-button-action clientside-admin-menu-save-button" value="<?php _e( 'Save Settings' ); ?>">
				<?php if ( ! is_multisite() || is_super_admin() ) { ?>
					<button class="button-secondary clientside-admin-menu-revert-button"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
				<?php } ?>
			</p>

		</form>

	</div>

</div>
