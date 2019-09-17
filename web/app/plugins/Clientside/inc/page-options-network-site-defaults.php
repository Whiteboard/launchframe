<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<?php Clientside_Pages::show_page_tabs( $page_info['slug'], true ); ?>

	<div class="clientside-page-sidebar clientside-page-sidebar--lower">

		<?php // Buttons ?>
		<div class="clientside-widget clientside-widget-empty">
			<input type="submit" class="button-primary clientside-button-action clientside-button-large clientside-button-w100p" data-js-relay=".clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
			<button class="button-secondary clientside-options-revert-button clientside-button-large clientside-button-w100p"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
		</div>

		<?php // Page description box ?>
		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">
				<p>
					<?php _e( 'These settings will be used as defaults when creating a new site in this network.', 'clientside' ); ?>
				</p>
			</div>
		</div>

		<?php // Sidebar menu ?>
		<div class="clientside-widget clientside-widget-empty">
			<div class="inside">
				<?php _e( 'Index', 'clientside' ); ?>
				<ul class="clientside-page-index-list">
					<?php foreach ( Clientside_Options::get_options_sections() as $section_slug => $section_info ) { ?>
						<?php if ( $section_info['page'] == 'clientside-options-general' ) { ?>
							<li><a href="#<?php echo esc_attr( $section_slug ); ?>" data-scrollto><?php echo $section_info['title']; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>

	</div>

	<?php settings_errors(); ?>

	<form method="post" action="edit.php?action=<?php echo Clientside_Options::$options_slug; ?>" class="clientside-page-content clientside-options-form">

		<input type="hidden" name="<?php echo Clientside_Options::$options_slug; ?>[<?php echo 'options-page-identification'; ?>]" value="<?php echo $page_info['slug']; ?>">

		<?php // Prepare options ?>
		<?php settings_fields( Clientside_Options::$options_slug ); ?>

		<?php // Show this page's option sections & fields ?>
		<?php if ( $page_info['slug'] == 'clientside-options-network-site-defaults' ) { ?>
			<?php do_settings_sections( 'clientside-options-general' ); ?>
		<?php } ?>
		<?php if ( $page_info['slug'] == 'clientside-options-network-widget-defaults' ) { ?>
			<?php do_settings_sections( 'clientside-admin-widget-manager' ); ?>
		<?php } ?>
		<?php if ( $page_info['slug'] == 'clientside-options-network-column-defaults' ) { ?>
			<?php do_settings_sections( 'clientside-admin-column-manager' ); ?>
		<?php } ?>
		<?php if ( $page_info['slug'] == 'clientside-options-network-cssjs-defaults' ) { ?>
			<?php do_settings_sections( 'clientside-custom-cssjs-tool' ); ?>
		<?php } ?>

		<p class="submit">
			<input type="submit" name="submit" class="button-primary clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
		</p>

	</form>

</div>
