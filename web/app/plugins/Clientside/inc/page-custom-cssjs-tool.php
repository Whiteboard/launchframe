<div class="wrap">

	<h1><?php echo $page_info['title']; ?></h1>

	<div class="clientside-page-sidebar clientside-page-sidebar--lowest">

		<div class="clientside-widget clientside-widget-empty">
			<input type="submit" class="button-primary clientside-button-action clientside-button-large clientside-button-w100p" data-js-relay=".clientside-custom-cssjs-save-button" value="<?php _e( 'Save Settings' ); ?>">
			<?php if ( ! is_multisite() || is_super_admin() ) { ?>
				<button class="button-secondary clientside-custom-cssjs-revert-button clientside-button-large clientside-button-w100p"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
			<?php } ?>
		</div>

		<div class="clientside-widget clientside-widget-empty">
			<div class="inside">
				<?php _e( 'Index', 'clientside' ); ?>
				<ul class="clientside-page-index-list">
					<?php $section = Clientside_Options::get_options_sections( 'clientside-custom-cssjs-site' ); ?>
					<li><a href="#<?php echo $section['slug']; ?>" data-scrollto><?php echo $section['title']; ?></a></li>
					<?php $section = Clientside_Options::get_options_sections( 'clientside-custom-cssjs-admin' ); ?>
					<li><a href="#<?php echo $section['slug']; ?>" data-scrollto><?php echo $section['title']; ?></a></li>
				</ul>
			</div>
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

		<form method="post" action="options.php" class="clientside-custom-cssjs-form">

			<input type="hidden" name="<?php echo Clientside_Options::$options_slug; ?>[<?php echo 'options-page-identification'; ?>]" value="<?php echo $page_info['slug']; ?>">

			<?php // Prepare options ?>
			<?php settings_fields( Clientside_Options::$options_slug ); ?>

			<?php // Show this page's option sections & fields ?>
			<?php do_settings_sections( $page_info['slug'] ); ?>

			<p class="submit">
				<input type="submit" class="button-primary clientside-button-action clientside-custom-cssjs-save-button" value="<?php _e( 'Save Settings' ); ?>">
				<?php if ( ! is_multisite() || is_super_admin() ) { ?>
					<button class="button-secondary clientside-custom-cssjs-revert-button"><?php _e( 'Revert to Defaults', 'clientside' ); ?></button>
				<?php } ?>
			</p>

		</form>

	</div>

</div>
