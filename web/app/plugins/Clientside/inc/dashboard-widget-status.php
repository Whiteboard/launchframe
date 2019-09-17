<ul class="clientside-status-list">

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Debug mode', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? __( 'Enabled', 'clientside' ) : __( 'Disabled', 'clientside' ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Post revisions', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ( defined( 'WP_POST_REVISIONS' ) && ! WP_POST_REVISIONS ) ? __( 'Disabled', 'clientside' ) : ( WP_POST_REVISIONS === true ? __( 'Enabled', 'clientside' ) : WP_POST_REVISIONS ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Theme/plugin file editor', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ( defined( 'DISALLOW_FILE_EDIT' ) && DISALLOW_FILE_EDIT ) ? __( 'Disabled', 'clientside' ) : __( 'Enabled', 'clientside' ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'WP Cron', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) ? __( 'Disabled', 'clientside' ) : __( 'Enabled', 'clientside' ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Media folder writable', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php
			$upload_dir = wp_upload_dir();
			if ( ! file_exists( $upload_dir['basedir'] ) ) {
				echo __( 'Not found', 'clientside' );
			}
			else {
				echo is_writable( $upload_dir['basedir'] ) ? __( 'Yes', 'clientside' ) : __( 'No', 'clientside' );
			}
			?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Max upload size', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo strtolower( ini_get( 'upload_max_filesize' ) ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Max execution time', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ini_get( 'max_execution_time' ); ?>s
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Gzip enabled', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo ( function_exists( 'ob_gzhandler' ) && ini_get( 'zlib.output_compression' ) ) ? __( 'Yes', 'clientside' ) : __( 'No', 'clientside' ); ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'PHP version', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php echo phpversion(); ?>
		</span>
	</li>

	<?php // Separator ?>
	<li class="clientside-status-separator"></li>

	<?php if ( is_network_admin() ) { ?>
		<?php $sitestats = get_sitestats(); ?>
		<?php if ( isset( $sitestats['blogs'] ) ) { ?>
			<li class="clientside-status-item">
				<span class="clientside-status-key">
					<?php _e( 'Sites' ); ?>
				</span>
				<span class="clientside-status-value">
					<?php echo $sitestats['blogs']; ?>
				</span>
			</li>
		<?php } ?>
	<?php } ?>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Users', 'User count', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php if ( function_exists( 'get_user_count' ) ) { ?>
				<?php echo get_user_count(); ?>
			<?php } else { ?>
				<?php $user_count = count_users(); ?>
				<?php echo $user_count['total_users']; ?>
			<?php } ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _e( 'Plugins' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php
			$plugin_count = get_transient( 'plugin_slugs' );
			$plugin_count = $plugin_count ? $plugin_count : array_keys( get_plugins() );
			echo count( $plugin_count );
			?>
		</span>
	</li>

	<?php if ( is_network_admin() ) { ?>
		<?php $theme_count = get_site_transient( 'update_themes' ); ?>
		<?php if ( $theme_count && isset( $theme_count->checked ) ) { ?>
			<li class="clientside-status-item">
				<span class="clientside-status-key">
					<?php _e( 'Themes' ); ?>
				</span>
				<span class="clientside-status-value">
					<?php echo count( $theme_count->checked ); ?>
				</span>
			</li>
		<?php } ?>
	<?php } ?>

	<?php if ( ! is_network_admin() ) { ?>
		<li class="clientside-status-item">
			<span class="clientside-status-key">
				<?php _e( 'Comments' ); ?>
			</span>
			<span class="clientside-status-value">
				<?php $comment_count = wp_count_comments(); ?>
				<?php echo $comment_count->total_comments; ?>
			</span>
		</li>
	<?php } ?>

	<?php // Separator ?>
	<li class="clientside-status-separator"></li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Site Title', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php if ( is_network_admin() ) { ?>
				<a href="<?php echo esc_url( admin_url( 'network/settings.php' ) ); ?>" title="<?php echo esc_attr( __( 'Change', 'clientside' ) ); ?>">
					<?php echo get_site_option( 'site_name' ); ?>
				</a>
			<?php } else { ?>
				<a href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>" title="<?php echo esc_attr( __( 'Change', 'clientside' ) ); ?>">
					<?php echo get_bloginfo( 'name' ); ?>
				</a>
			<?php } ?>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Site URL', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<a href="<?php echo esc_url( home_url() ); ?>" title="<?php _e( 'Visit', 'clientside' ); ?>"><?php echo home_url(); ?></a>
		</span>
	</li>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'Admin Email', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<?php if ( is_network_admin() ) { ?>
				<?php echo get_site_option( 'admin_email' ); ?>
			<?php } else { ?>
				<?php echo get_bloginfo( 'admin_email' ); ?>
			<?php } ?>
		</span>
	</li>

	<?php if ( ! is_network_admin() ) { ?>
		<li class="clientside-status-item">
			<span class="clientside-status-key">
				<?php _ex( 'Active Theme', 'Site / server status', 'clientside' ); ?>
			</span>
			<span class="clientside-status-value">
				<?php $theme = wp_get_theme(); ?>
				<a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>" title="<?php echo esc_attr( __( 'Change', 'clientside' ) ); ?>"><?php echo $theme->Name; ?></a>
			</span>
		</li>
	<?php } ?>

	<?php if ( ! is_network_admin() ) { ?>
		<li class="clientside-status-item">
			<span class="clientside-status-key">
				<?php _ex( 'Permalink Structure', 'Site / server status', 'clientside' ); ?>
			</span>
			<span class="clientside-status-value">
				<?php $permalink_structure = get_option('permalink_structure'); ?>
				<?php $permalink_structure = $permalink_structure ? $permalink_structure : __( 'None', 'clientside' ); ?>
				<a href="<?php echo esc_url( admin_url( 'options-permalink.php' ) ); ?>" title="<?php echo esc_attr( __( 'Change', 'clientside' ) ); ?>"><?php echo $permalink_structure; ?></a>
			</span>
		</li>
	<?php } ?>

	<li class="clientside-status-item">
		<span class="clientside-status-key">
			<?php _ex( 'WordPress version', 'Site / server status', 'clientside' ); ?>
		</span>
		<span class="clientside-status-value">
			<a href="<?php echo esc_url( admin_url( 'update-core.php' ) ); ?>" title="<?php echo esc_attr( __( 'Check for updates', 'clientside' ) ); ?>"><?php echo get_bloginfo('version'); ?></a>
			<?php if ( get_bloginfo('version') < 4 ) { ?>
				<p><?php _ex( 'Clientside needs a minimum WordPress version of 4.0 to perform. Please consider upgrading.', 'Upgrade notice', 'clientside' ); ?></p>
			<?php } ?>
		</span>
	</li>

</ul>
