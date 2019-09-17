<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<?php Clientside_Pages::show_page_tabs( $page_info['slug'] ); ?>

	<div class="clientside-page-sidebar clientside-page-sidebar--lower">

		<div class="clientside-widget clientside-widget-empty">
			<input type="submit" class="button-primary clientside-button-action clientside-button-large clientside-button-w100p" data-js-relay=".clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
			<?php if ( ! is_multisite() || is_super_admin() ) { ?>
				<button class="button-secondary clientside-options-revert-button clientside-button-large clientside-button-w100p"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
			<?php } ?>
		</div>

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

		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">
				<?php if ( is_multisite() ) { ?>

					<?php if ( Clientside_Options::get_saved_network_option( 'network-admins-only' ) ) { ?>
						<p><?php _e( 'Note that only Network Administrators have access to these settings.', 'clientside' ); ?></p>
					<?php } else { ?>
						<p><?php _e( 'Note that both Network Administrators and Site Administrators have access to these settings.', 'clientside' ); ?></p>
					<?php } ?>

					<?php if ( is_super_admin() ) { ?>
						<p><?php _e( 'Visit the Network Options to change this behavior.', 'clientside' ); ?></p>
						<a class="clientside-button-lined clientside-button-large clientside-button-w100p" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-network' ); ?>"><?php _e( 'Network Options', 'clientside' ); ?></a>
					<?php } ?>

				<?php } else { ?>
					<?php _e( 'Note that only Administrators have access to these settings.', 'clientside' ); ?>
				<?php } ?>

			</div>
		</div>

		<?php if ( is_multisite() ) { ?>
			<div class="clientside-widget clientside-widget-bordered">
				<div class="inside">
					<p><?php _e( 'Note that these settings only apply to the current site &ndash; not all sites in the network.', 'clientside' ); ?></p>
				</div>
			</div>
		<?php } ?>

		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">
				<p>
					To manage the admin menu items that other user roles get to see, visit <a href="<?php echo Clientside_Pages::get_page_url( 'clientside-admin-menu-editor' ); ?>">the Admin Menu Editor Tool</a>.
				</p>
				<p>
					<a class="clientside-button-lined clientside-button-large clientside-button-w100p" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>"><?php _e( 'View all Tools', 'clientside' ); ?></a>
				</p>
			</div>
		</div>

	</div>

	<?php settings_errors(); ?>

	<form method="post" action="options.php" class="clientside-page-content clientside-options-form">

		<input type="hidden" name="<?php echo Clientside_Options::$options_slug; ?>[<?php echo 'options-page-identification'; ?>]" value="<?php echo $page_info['slug']; ?>">

		<?php // Prepare options ?>
		<?php settings_fields( Clientside_Options::$options_slug ); ?>

		<?php // Show this page's option sections & fields ?>
		<?php do_settings_sections( $page_info['slug'] ); ?>

		<p class="submit">
			<input type="submit" name="submit" class="button-primary clientside-options-save-button" value="<?php _e( 'Save Settings' ); ?>">
		</p>

	</form>

</div>
