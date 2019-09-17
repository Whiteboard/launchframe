<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<?php Clientside_Pages::show_page_tabs( $page_info['slug'] ); ?>

	<div class="clientside-page-sidebar">

		<div class="clientside-widget clientside-widget-bordered">
			<div class="inside">

				<p>
					<?php _e( 'Use this page to import/export Clientside settings and configurations. Press Export to generate a text string which can then be imported later or in another installation (also useful for copying settings among a multisite installation).', 'clientside' ); ?>
				</p>

				<?php if ( is_multisite() ) { ?>

					<?php if ( Clientside_Options::get_saved_network_option( 'network-admins-only' ) ) { ?>
						<p><?php _e( 'Note that only Network Administrators have access to this tool.', 'clientside' ); ?></p>
					<?php } else { ?>
						<p><?php _e( 'Note that both Network Administrators and Site Administrators have access to this tool.', 'clientside' ); ?></p>
					<?php } ?>

					<?php if ( is_super_admin() ) { ?>
						<p><?php _e( 'Visit the Network Options to change this behavior.', 'clientside' ); ?></p>
						<a class="clientside-button-lined clientside-button-large clientside-button-w100p" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-network' ); ?>"><?php _e( 'Network Options', 'clientside' ); ?></a>
					<?php } ?>

				<?php } else { ?>
					<?php _e( 'Note that only Administrators have access to this tool.', 'clientside' ); ?>
				<?php } ?>

			</div>
		</div>

		<div class="clientside-widget clientside-widget-bordered">
			<h2 class="hndle">
				<?php _e( 'Warning', 'clientside' ); ?>
			</h2>
			<div class="inside">
				<p><?php _e( "Importing the Menu Editor Tool's configuration can cause unexpected results if the target site has different menu items.", 'clientside' ); ?></p>
				<p><?php _e( "Importing settings will overwrite the current site's settings!", 'clientside' ); ?></p>
			</div>
		</div>

	</div>

	<div class="clientside-page-content">

		<?php if ( isset( $_REQUEST['updated'] ) && $_REQUEST['updated'] ) { ?>
			<div class="notice"><?php _e( 'Import succeeded.', 'clientside' ); ?></div>
		<?php } ?>

		<h3 class="clientside-header-underlined">Import</h3>

		<form method="post" action="" class="clientside-options-form">

			<?php wp_nonce_field( 'clientside-import', 'clientside-import-nonce' ); ?>

			<textarea class="widefat clientside-import-textarea" name="import" rows="10" placeholder="<?php _e( 'Paste an export string here to import.', 'clientside' ); ?>"></textarea>

			<p class="submit">
				<input type="submit" class="button button-primary clientside-import-button" disabled value="<?php _e( 'Import', 'clientside' ); ?>">
			</p>

		</form>

		<h3 class="clientside-header-underlined">Export</h3>

		<noscript>
			<p>
				<?php _e( 'Please enable Javascript to make use of this functionality.', 'clientside' ); ?>
			</p>
		</noscript>

		<fieldset>
			<label for="clientside-export-checkbox-options">
				<input type="checkbox" id="clientside-export-checkbox-options" <?php checked( true ); ?>>
				<?php _e( 'Clientside Plugin Options', 'clientside' ); ?>
			</label>
			<br>
			<?php if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) ) { ?>
				<label for="clientside-export-checkbox-menu-editor">
					<input type="checkbox" id="clientside-export-checkbox-menu-editor">
					<?php _e( 'Menu Editor Tool Configuration', 'clientside' ); ?>
				</label>
				<br>
			<?php } ?>
			<?php if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) ) { ?>
				<label for="clientside-export-checkbox-widget-manager">
					<input type="checkbox" id="clientside-export-checkbox-widget-manager" <?php checked( true ); ?>>
					<?php _e( 'Admin Widget Manager Tool Configuration', 'clientside' ); ?>
				</label>
				<br>
			<?php } ?>
			<?php if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) ) { ?>
				<label for="clientside-export-checkbox-column-manager">
					<input type="checkbox" id="clientside-export-checkbox-column-manager" <?php checked( true ); ?>>
					<?php _e( 'Admin Column Manager Tool Configuration', 'clientside' ); ?>
				</label>
				<br>
			<?php } ?>
			<?php if ( ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) { ?>
				<label for="clientside-export-checkbox-custom-cssjs">
					<input type="checkbox" id="clientside-export-checkbox-custom-cssjs">
					<?php _e( 'Custom CSS/JS Tool Configuration', 'clientside' ); ?>
				</label>
			<?php } ?>
		</fieldset>

		<p>
			<button class="button button-primary clientside-export-button"><?php _ex( 'Export', 'Button text', 'clientside' ); ?></button>
		</p>

		<p class="clientside-export-status"></p>
		<div class="clientside-export-result" style="display: none;">
			<textarea class="widefat clientside-export-textarea" placeholder="<?php echo esc_attr( __( 'Press the Export button above.', 'clientside' ) ); ?>" rows="10"></textarea>
			<p class="help">
				<?php _e( 'Save this text string as a backup or copy it over to another installation to import it.', 'clientside' ); ?><br>
			</p>
		</div>

	</div>

</div>
