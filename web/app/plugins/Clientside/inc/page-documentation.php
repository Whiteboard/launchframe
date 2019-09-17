<div class="wrap clientside-docs">

	<h1><?php echo $page_info['title']; ?></h1>

	<?php Clientside_Pages::show_page_tabs( $page_info['slug'] ); ?>

	<div class="clientside-page-sidebar">
		<div class="clientside-widget clientside-widget-bordered">
			<div class="hndle">
				<?php _e( 'Support', 'clientside' ); ?>
			</div>
			<div class="inside">
				<p>
					<!--<a href="http://codecanyon.net/user/Frique" title="Frique on CodeCanyon">contact the author via CodeCanyon</a> or-->
					Visit the official support page for direct product support and options on contacting the author directly.
				</p>
				<p>
					<a class="clientside-button-lined clientside-button-large clientside-button-w100p" href="https://frique.me/support/" title="https://frique.me/support/">Frique Support Page</a>
				</p>
			</div>
		</div>
	</div>

	<div class="clientside-page-content">

		<div class="clientside-widget clientside-widget-bordered">
			<ol class="inside clientside-docs-index">
				<li><a href="#clientside-doc-installation" data-scrollto>Installation</a></li>
				<li><a href="#clientside-doc-options" data-scrollto>Finding the Plugin Options</a></li>
				<li><a href="#clientside-doc-updating" data-scrollto>Updating the plugin</a></li>
				<li><a href="#clientside-doc-uninstall" data-scrollto>Deactivating / Uninstalling the plugin</a></li>
				<li><a href="#clientside-doc-import-export" data-scrollto>How to backup your settings</a></li>
				<li><a href="#clientside-doc-admin-menu-editor" data-scrollto>Customizing the admin menu with the Admin Menu Editor Tool</a></li>
				<li><a href="#clientside-doc-disabling-menu-editor" data-scrollto>How do I disable the Clientside Menu Editor?</a></li>
				<li><a href="#clientside-doc-admin-widget-manager" data-scrollto>Hiding admin page sections with the Admin Widget Manager Tool</a></li>
				<li><a href="#clientside-doc-notification-center" data-scrollto>Using or disabling the Notification Center</a></li>
				<li><a href="#clientside-doc-hiding" data-scrollto>Hiding other admin page sections</a></li>
				<li><a href="#clientside-doc-admin-column-manager" data-scrollto>Hiding post (any type) listing columns with the Admin Column Manager Tool</a></li>
				<li><a href="#clientside-doc-upload-logo" data-scrollto>Uploading a custom logo image</a></li>
				<li><a href="#clientside-doc-long-menu" data-scrollto>Accessing menu items in long admin menus</a></li>
				<li><a href="#clientside-doc-network-options" data-scrollto>Managing network (multisite) options</a></li>
				<li><a href="#clientside-doc-disable-theme" data-scrollto>Using Clientside functionality without the theme</a></li>
				<li><a href="#clientside-doc-custom-cssjs" data-scrollto>Injecting custom CSS and javascript with the Custom CSS/JS Tool</a></li>
				<li><a href="#clientside-doc-custom-styling" data-scrollto>Customizing colors and other styling</a></li>
				<li><a href="#clientside-doc-support" data-scrollto>Support</a></li>
			</ol>
		</div>

		<h3 class="clientside-header-underlined" id="clientside-doc-installation">
			Installation
		</h3>

		<p>
			Note that the downloaded zip file contains the documentation, licensining info and a zip file with the actual plugin.
		</p>

		<h4>Upload via (S)FTP</h4>
		<ol>
			<li>First unpack the downloaded zip file and find the Clientside zip-file inside.</li>
			<li>Unzip it to extract the Clientside plugin folder.</li>
			<li>Upload the folder via FTP to your installation's wp-content/plugins/ folder.</li>
			<li>Then log into the WordPress site where Clientside will now appear on the Plugins page.</li>
			<li>Press Activate.</li>
		</ol>
		<h4>Or upload via the WP admin area</h4>
		<ol>
			<li>Unpack the downloaded zip file to find the zipped plugin file inside.</li>
			<li>Log into your WordPress site and visit the Plugins page.</li>
			<li>Press "Add New", followed by "Upload Plugin".</li>
			<li>Here you can browse your system to find the plugin zip file. Select it to start uploading the plugin.</li>
			<li>It will then appear on the Plugins page where it can be activated.</li>
		</ol>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-options">
			Finding the Plugin Options
		</h3>

		<p>
			After installation and activation, a new "Admin Theme" menu item is available under "Appearance". This holds the plugin options and links to related pages.
		</p>
		<p>
			Additionally, Clientside has its own "Settings" button in the plugin listing.
		</p>
		<p>
			Note that the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a> and <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">Tools</a> are only available to Administrator type users (specifically users with the "<a href="http://codex.wordpress.org/Roles_and_Capabilities#edit_theme_options" title="About edit_theme_options in the WordPress Codex">edit_theme_options</a>" capability).
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-updating">
			Updating the plugin
		</h3>

		<!--
		<p>
			Updating Clientside works just like any other plugin. If an update is available a notification will appear in the plugin list or the general WordPress updates page, along with a button to install the update.<br>
		</p>
		-->
		<p>
			Visit your CodeCanyon downloads page to download the latest version of Clientside. Simply replace the plugin folder with a newer one to upgrade.
		</p>
		<p>
			All settings are kept when updating and deactivation / uninstallation prior to updating is not necessary.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-uninstall">
			Deactivating / Uninstalling the plugin
		</h3>

		<p>
			To deactivate Clientside; visit the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Plugins page</a> in the WordPress installation that has Clientside installed. Find Clientside in the list, hover over it or tap it to see the action buttons and press "Deactivate". This will disable the plugin without uninstalling it. All settings will remain.
		</p>

		<p>
			To uninstall Clientside; first deactivate it as described above and then press "Delete". This will completely remove the plugin files as well as erase the plugin settings.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-import-export">
			How to backup and restore your settings and configurations
		</h3>

		<p>
			Visit the "Import/export Settings" tab under Appearance > Admin Theme to find the import/exporting features for the Clientside options.
		</p>
		<p>
			Under Export you can choose which sections to export. Hitting the Export button will generate a text string that can be used to import the settings at a later time or in a different Clientside installation.
		</p>
		<p>
			Under Import you can paste a previously exported text string to reapply the exported settings to the current installation. Importing settings overwrites existing settings in the sections it applies to. Sections that were not included in the export will be ignored when importing.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-admin-menu-editor">
			Customizing the admin menu with the Admin Menu Editor Tool
		</h3>

		<p>
			One of Clientside’s bundled tools is the “<a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-admin-menu-editor' ); ?>">Admin Menu Editor</a>”. You can find it via the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">Clientside Tools page</a>, or in the menu under Tools.
		</p>

		<p>
			The menu editor allows you to reorder menu items, rename them and conditionally hide them for specific user roles. This avoids confusion and distraction for the affected user group.
		</p>

		<p>
			Note that this tool does not create or remove permissions (user capabilities) necessary to view certain pages. Therefore a page can still be inaccessible to a certain user group even if you enable it in the menu editor.
		</p>

		<h4>Reordering menu items</h4>
		<p>
			To rearrange menu items simply click & drag them in the menu editor. Drop it somewhere else and press “Save Settings” to apply the new menu order.
			Note that reordering is currently only possible for main menu items (not submenu items).
		</p>

		<h4>Renaming menu items</h4>
		<p>
			To rename a menu item, click on the “Edit” button next to it and enter a new title in the text field. The changes are applied after pressing "Save Settings”.
		</p>

		<h4>Hiding menu items</h4>
		<p>
			To hide a menu item, click on the “Edit” button next to it and check/uncheck the checkboxes next to their corresponding user role names to manage its visibility. Unchecking a box will hide the menu item for that user group. The changes are applied after pressing "Save Settings”.<br>
			Note that greyed out user roles signify that the item is already not available to that user role (due to user capabilities) or that it is locked. For example the Admin Menu Editor page is locked to the Administrator because otherwise the editor could become forever unavailable after hiding it, along with the ability to revert it.
		</p>

		<h4>Reverting customizations</h4>
		<p>
			You can always revert the menu customizations to their defaults by clicking the “Revert to Defaults” button next to “Save Settings” on the menu editor page. All custom ordering, renaming and hiding are then reset to their default state.
		</p>

		<h4>Want more?</h4>
		<p>
			As with the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">other tools</a> included in Clientside, they are limited to their basic functionality. For more control, it is advised to turn to a dedicated plugin for the specific purpose.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-disabling-menu-editor">
			How do I disable the Clientside Menu Editor?
		</h3>

		<p>
			To prevent any manipulation of the menu, simply revert the Menu Editor Tool's configuration on <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-admin-menu-editor' ); ?>">its page</a>.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-admin-widget-manager">
			Hiding admin page sections with the Admin Widget Manager Tool
		</h3>

		<p>
			One of Clientside’s bundled tools is the “<a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-admin-widget-manager' ); ?>">Admin Widget Manager</a>”. You can find it via the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">Clientside Tools page</a>, or in the menu under Tools.
		</p>

		<p>
			The widget manager allows you to choose which admin widgets are visible to which user group. The widget manager lists widgets belonging to the Dashboard page and the Post Edit screen (all post types). Hiding a widget also makes it disappear from the page’s Screen Options.<br>
			<span class="description">To hide other page sections throughout the admin areas, also see the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a>.</span>
		</p>

		<h4>Hiding admin widgets</h4>
		<p>
			To hide a widget, check/uncheck the checkboxes next to their corresponding user role names to manage its visibility. Unchecking a box will hide the widget for that user group. The changes are applied after pressing "Save Settings”.<br>
			Greyed out user roles signify that the widget is already not available to that user role (due to user capabilities).
		</p>

		<h4>Reverting customizations</h4>
		<p>
			You can always revert the customizations to their defaults by clicking the “Revert to Defaults” button next to “Save Settings” on the widget manager page.
		</p>

		<h4>Want more?</h4>
		<p>
			As with the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">other tools</a> included in Clientside, they are limited to their basic functionality. For more control, it is advised to turn to a dedicated plugin for the specific purpose.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-notification-center">
			Using or disabling the Notification Center
		</h3>

		<p>
			Since version 1.1, Clientside puts notifications / alerts inside a Notification Center on the right side of the toolbar. This keeps the page layout uninterrupted, prevents distraction and still provides access to notifications if desired.
		</p>
		<p>
			The toolbar item won't show until there are notifications to show. The toolbar icon will show red if there are important alerts or errors. Regular notifications such as "Settings saved" will disappear when navigating away from the page. No interaction is needed.
		</p>
		<p>
			If not appreciated, the Notification Center can be disabled (this is a role-based setting) on the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a> page. Look for the option called "Notification Center" and uncheck the box to disable it.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-hiding">
			Hiding other admin page sections
		</h3>

		<p>
			Many other aspects of the interface can be disabled/hidden via the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a>. The options are divided into relevant categories and often can be set independently to apply to specific user roles.
		</p>
		<p>
			Hiding elements using the plugin options does not permanently remove them. When reverting the options or uninstalling Clientside, everything is back to their default state.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-admin-column-manager">
			Hiding post (any type) listing columns with the Admin Column Manager Tool
		</h3>

		<p>
			One of Clientside’s bundled tools is the “<a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-admin-column-manager' ); ?>">Admin Column Manager</a>”. You can find it via the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">Clientside Tools page</a>, or in the menu under Tools.
		</p>

		<p>
			The column manager allows you to choose which listing columns are visible to which user group. Hiding a column also makes it disappear from the page’s Screen Options.
		</p>

		<h4>Hiding columns</h4>
		<p>
			To hide a column, check/uncheck the checkboxes next to their corresponding user role names to manage its visibility. Unchecking a box will hide the column for that user group. The changes are applied after pressing "Save Settings”.<br>
			Greyed out user roles signify that the column is already not available to that user role (due to user capabilities).
		</p>

		<h4>Reverting customizations</h4>
		<p>
			You can always revert the customizations to their defaults by clicking the “Revert to Defaults” button next to “Save Settings” on the column manager page.
		</p>

		<h4>Want more?</h4>
		<p>
			As with the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">other tools</a> included in Clientside, they are limited to their basic functionality. For more control, it is advised to turn to a dedicated plugin for the specific purpose.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-upload-logo">
			Uploading a custom logo image
		</h3>

		<p>
			The logo that appears on the login page and in the top-left corner of the admin area can be customized with your own image file. To upload your logo, visit the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a> page and find the "Login page logo image" option and press Upload. This will show the general WordPress Media Manager where you can select an existing file or upload a new one. Select an image and press "Insert into post" to confirm your choice.<br>
			Save the settings to apply the changes.
		</p>
		<p>
			Alternatively you can supply the URL to an image in the text field above the Upload button.
		</p>
		<p>
			Simply empty the URL text field and save the settings to revert back to the default WordPress logo.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-long-menus">
			Accessing menu items in long admin menus
		</h3>

		<p>
			If the admin menu gets longer than the page, you can scroll through it independently from the content area. Simply move the mouse over it and scroll, or swipe it if using a touch device. This ensures all menu items are always accessible.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-network-options">
			Managing network (multisite) options
		</h3>

		<p>
			To access the network options page:
		</p>
		<ul>
			<li>Make sure Clientside is network activated or active on the main site.</li>
			<li>In the network admin area (not the main site), find "Admin Theme" in the menu under "Themes".</li>
		</ul>
		<p>
			If you want to end up using Clientside on child sites but not the main site, you can safely deactivate Clientside on the main site after setting up the network options (if it's not network activated).
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-disable-theme">
			Using Clientside functionality without the theme
		</h3>

		<p>
			The theming aspect of Clientside can be individually disabled without deactivating the plugin. This way you can make use of the functionality changes the plugin provides without changing the WordPress interface styling.
		</p>
		<p>
			To enable/disable Clientside theming, find the option "Enable Clientside admin theming" on the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-options-general' ); ?>">Clientside Plugin Options</a> page. This is a user role specific option.
		</p>
		<p>
			Note that certain options still rely on theming being enabled.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-custom-cssjs">
			Injecting custom CSS and javascript with the Custom CSS/JS Tool
		</h3>

		<p>
			One of Clientside’s bundled tools is the “<a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-custom-cssjs-tool' ); ?>">Custom CSS/JS Tool</a>”. You can find it via the <a class="clientside-internal-link" href="<?php echo Clientside_Pages::get_page_url( 'clientside-tools' ); ?>">Clientside Tools page</a>, or in the menu under Tools.
		</p>
		<p>
			Writing CSS styles or javascript code into the text areas and saving the page will inject these snippets into the site or admin area accordingly. This can be used to overwrite or add to existing styles and scripts if you know how to do so.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-custom-styling">
			Customizing colors and other styling
		</h3>

		<p>
			Besides the predefined menu color schemes, the plugin doesn't support any other theming configuration. To achieve other customizations, you can use the Custom JS/CSS tool if you are confortable applying custom CSS. You can enter the rules under Tools > Custom CSS/JS in the CSS box under "Admin area and login screen".
		</p>
		<p>
			Some examples:
		</p>

<h4>Body background color</h4>
<pre><code>body,
#wpadminbar #wp-admin-bar-top-secondary,
.clientside-back-to-top {
	background-color: white !important;
}</code></pre>

<h4>Menu background color:</h4>
<pre><code>#adminmenuwrap {
	background-color: black !important;
}</code></pre>

<h4>Menu text color:</h4>
<pre><code>.clientside-theme #adminmenu>li>a {
	color: white !important;
}
.clientside-theme #adminmenu > li > a:hover {
	color: red !important;
}</code></pre>

<h4>Submenu text color:</h4>
<pre><code>.clientside-theme #adminmenu .wp-submenu a {
	color: #ccc !important;
}
.clientside-theme #adminmenu .wp-submenu a:hover {
	color: #eee !important;
}</code></pre>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>

		<h3 class="clientside-header-underlined" id="clientside-doc-support">
			Support
		</h3>

		<p>
			Visit the <a href="https://frique.me/support/" title="https://frique.me/support/">Frique Support Page</a> to find support options from the author.
		</p>

		<p>
			<a class="clientside-docs-backtotop" href="#wpwrap" data-scrollto>Back to top</a>
		</p>


	</div>

</div>
