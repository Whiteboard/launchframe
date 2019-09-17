/*!
 * This file is part of: Clientside
 * Author: Berend de Jong
 * Author URI: https://frique.me/
 * Version: 1.14.5 (2019-05-04 22:13)
 */

jQuery( function( $ ) {

	/**
	 * Table of contents
	 *
	 * 1.0 Setup
	 * 2.0 Better placeholders
	 * 3.0 Widget close buttons
	 * 4.0 Open Screen Options & Help in a lightbox
	 * 5.0 Revert Clientside Options
	 * 6.0 Admin Menu Editor Tool
	 * 7.0 Admin Widget Manager
	 * 8.0 Admin Column Manager
	 * 9.0 Custom CSS/JS tool
	 * 10.0 Custom Media Manager trigger
	 * 11.0 Main menu
	 * 12.0 Conditional highlighting of elements
	 * 13.0 Add global back-to-top button
	 * 14.0 Animating scroll triggers
	 * 15.0 Add warning when navigating away when theme/plugin editor is used
	 * 16.0 Add a .wrap to (plugin) pages that don't have one
	 * 17.0 Notification Center
	 * 18.0 Import/export functionality
	 * 19.0 Insert tab character on tab keypress in code textarea
	 * 20.0 Post table row overlay
	 * 20.1 Post table selected row state
	 * 21.0 User role checkboxes toggle
	 * 22.0 Tax term creation form placeholders / information tooltips
	 * 23.0 Manage tinymce editor toolbar fixed position
	 */

	/* 1.0 Setup */

	"use strict";

	// Globals: clientside, clientside.L10n
	var $window = $( window );
	var $document = $( document );
	var $body = $( 'body' );
	clientside.themeEnabled = parseInt( clientside.themeEnabled, 10 );
	clientside.clientsideEnabled = parseInt( clientside.clientsideEnabled, 10 );

	/* 2.0 Better placeholders */

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		// Add placeholder attributes in favor of fake placeholder labels
		$( '.clientside-theme #dashboard_quick_press' ).find( '#title' ).attr( 'placeholder', $.trim( $( this ).find( '#title-prompt-text' ).text() ) );
		$( '.clientside-theme #dashboard_quick_press' ).find( '#content' ).attr( 'placeholder', $.trim( $( this ).find( '#content-prompt-text' ).text() ) );
		$( '.clientside-theme.post-php, .clientside-theme.post-new-php' ).find( '#title' ).attr( 'placeholder', $.trim( $( '#title-prompt-text' ).text() ) );

	}

	/* 3.0 Widget close buttons */

	if ( clientside.clientsideEnabled && clientside.themeEnabled && clientside.metaboxCloseEnabled ) {

		// Add close buttons to widgets
		$( '.clientside-theme .postbox' ).not( '#submitdiv' ).each( function( i ) {

			var $this = $( this );
			var $minimize = $this.children( '.handlediv' );
			var name = this.id + '-hide';
			var value = this.id;
			var html = '';

			// Output checkbox HTML
			if ( $minimize.length ) {
				html += '<label class="clientside-widget-close">';
					html += '<span class="dashicons dashicons-no-alt"></span>';
					html += '<input type="checkbox" class="hide-postbox-tog" name="' + name + '" value="' + value + '" checked="checked">';
				html += '</label>';
				$this.prepend( $( html ) );
			}

		} );

		// Event: Re-check unchecked widget hiding checkbox when enabled from other checkbox
		$document.on( 'change', '.hide-postbox-tog', function() {

			var $this = $( this );
			var name = $this.attr( 'name' );
			$( '.hide-postbox-tog' ).filter( '[name="' + name + '"]' ).prop( 'checked', $this.prop( 'checked' ) );

		} );

	}

	/* 4.0 Open Screen Options & Help in a lightbox */

	// Replace Screen Options / Help button events with Fancybox popup
	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {
		window.screenMeta = {
			init: function() {}
		};
		// Pre WP 4.3
		$( '.screen-meta-toggle a' ).each( function() {
			var $this = $( this ).addClass( 'thickbox thickbox--clientside' );
			var width = 600;
			var height = 400;
			var target = $this.attr( 'href' ).substring( 1 );
			$this.attr( 'href', '#TB_inline?width=' + width + '&height=' + height + '&inlineId=' + target );
			// Add Screen Options title
			if ( $this.is( $( '#show-settings-link' ) ) ) {
				$this.attr( 'title', clientside.L10n.screenOptions );
			}
			// Add Help title
			if ( $this.is( $( '#contextual-help-link' ) ) ) {
				$this.attr( 'title', clientside.L10n.help );
			}
		} );
		// WP 4.3+
		if ( $( '.screen-meta-toggle button' ).length ) {
			// Screen options
			$( '#show-settings-link' ).on( 'click', function() {
				tb_show( clientside.L10n.screenOptions, '#TB_inline?inlineId=screen-options-wrap' );
			} );
			// Help
			$( '#contextual-help-link' ).on( 'click', function() {
				tb_show( clientside.L10n.help, '#TB_inline?inlineId=contextual-help-wrap' );
			} );
		}
	}

	// Prevent JS error when closing the lightbox
	//todo Accessibility issue
	setTimeout( function() {
		$( 'body' ).off( 'thickbox:removed' );
	}, 100 );

	/* 5.0 Revert Clientside Options */

	// Event: General Options Revert button click
	$( '.clientside-options-revert-button' ).on( 'click', function( e ) {

		e.preventDefault();

		if ( confirm( clientside.L10n.revertConfirm ) ) {
			// Add a revert request field to the form & submit it
			$( '.clientside-options-form' ).prepend( '<input type="hidden" name="' + clientside.options_slug + '[clientside-revert-page]" value="1" />' );
			$( '.clientside-options-save-button' ).trigger( 'click' );
		}

	});

	/* 6.0 Admin Menu Editor Tool */

	// Process changes
	function clientside_process_admin_menu_editor() {

		var $menu_list = $(' .clientside-admin-menu-editor ');
		var data;

		// Also collect values of unchecked checkboxes
		$menu_list.find(':checkbox:disabled').prop( 'disabled', false ).addClass( '-disabled' );
		$menu_list.find(':checkbox:not(:checked)').attr( 'value', '0' ).prop( 'checked', true ).addClass( '-unchecked' );

		// Collect data
		data = $menu_list.find( ':input' ).serializeArray();
		data = JSON.stringify( data );

		// Put checkboxes back to normal
		$menu_list.find( '.-disabled' ).prop( 'disabled', true ).removeClass( '-disabled' );
		$menu_list.find( '.-unchecked' ).attr( 'value', '1' ).prop( 'checked', false ).removeClass( '-unchecked' );

		// Enter data into plugin option form field
		$( '#clientside-formfield-admin-menu' ).val( data );

	}

	// Activate jQuery UI Sortable
	if ( $.ui && typeof $.ui.sortable === 'function' && $( '.clientside-admin-menu-editor-mainmenu' ).length ) {
		$( '.clientside-admin-menu-editor-mainmenu' ).sortable( {
			// Elements to exclude from dragging
			cancel: '.clientside-admin-menu-editor-item-edit, .clientside-admin-menu-editor-item-settings, .clientside-admin-menu-editor-submenu',
			// CSS class to give to the drop area
			placeholder: 'sortable-placeholder',
			update: function() {

				// Browser warning when navigating away without saving changes
				window.onbeforeunload = function() {
					return clientside.L10n.saveAlert;
				};

				// Process new menu settings into hidden form field
				clientside_process_admin_menu_editor();

			}
		} );
	}

	// Event: Edit button click
	$document.on( 'click', '.clientside-admin-menu-editor-item-edit', function( e ) {
		e.preventDefault();
		e.stopPropagation();
		$( this ).parents( '.clientside-admin-menu-editor-page' ).toggleClass( '-open' );
	} );
	$document.on( 'click', '.clientside-admin-menu-editor-page', function( e ) {
		e.preventDefault();
		$( this ).toggleClass( '-open' );
	} );

	// Prevent closing the menu item when clicking around the settings
	$document.on( 'click', '.clientside-admin-menu-editor-item-settings', function( e ) {
		e.stopPropagation();
	} );

	// Event: Save button click
	$( '.clientside-admin-menu-save-button' ).on( 'click', function() {

		// Remove save warning message if present
		window.onbeforeunload = null;

	} );

	// Event: Admin Menu Editor Revert button click
	$( '.clientside-admin-menu-revert-button' ).on( 'click', function( e ) {

		e.preventDefault();

		if ( confirm( clientside.L10n.revertConfirm ) ) {
			// Empty the form value & submit the form
			$( '#clientside-formfield-admin-menu' ).val( '' );
			$( '.clientside-admin-menu-save-button' ).trigger( 'click' );
		}

	});

	// Event: Process any changes to the menu items
	$( '.clientside-admin-menu-editor' ).on( 'change blur', 'input', function( e ) {
		clientside_process_admin_menu_editor();
	} );

	/* 7.0 Admin Widget Manager */

	// Event: Admin Widget Manager Revert button click
	$( '.clientside-admin-widget-revert-button' ).on( 'click', function( e ) {

		e.preventDefault();

		if ( confirm( clientside.L10n.revertConfirm ) ) {
			// Add a revert request field to the form & submit it
			$( '.clientside-admin-widget-manager-form' ).prepend( '<input type="hidden" name="' + clientside.options_slug + '[clientside-revert-page]" value="1" />' );
			$( '.clientside-admin-widget-save-button' ).trigger( 'click' );
		}

	});

	/* 8.0 Admin Column Manager */

	// Event: Admin Column Manager Revert button click
	$( '.clientside-admin-column-revert-button' ).on( 'click', function( e ) {

		e.preventDefault();

		if ( confirm( clientside.L10n.revertConfirm ) ) {
			// Add a revert request field to the form & submit it
			$( '.clientside-admin-column-manager-form' ).prepend( '<input type="hidden" name="' + clientside.options_slug + '[clientside-revert-page]" value="1" />' );
			$( '.clientside-admin-column-save-button' ).trigger( 'click' );
		}

	});

	/* 9.0 Custom CSS/JS tool */

	// Event: Revert button click
	$( '.clientside-custom-cssjs-revert-button' ).on( 'click', function( e ) {

		e.preventDefault();

		if ( confirm( clientside.L10n.revertConfirm ) ) {
			// Add a revert request field to the form & submit it
			$( '.clientside-custom-cssjs-form' ).prepend( '<input type="hidden" name="' + clientside.options_slug + '[clientside-revert-page]" value="1" />' );
			$( '.clientside-custom-cssjs-save-button' ).trigger( 'click' );
		}

	});

	/* 10.0 Custom Media Manager trigger */

	$( '.clientside-media-select-button' ).on( 'click', function( e ) {

		e.preventDefault();
		var $this = $( this );
		var $input = $( '#' + this.id.replace( '-upload-button', '' ) );
		var $preview = $( '#' + this.id.replace( '-upload-button', '-preview' ) );
		var $preview_image = $( '#' + this.id.replace( '-upload-button', '-preview-image' ) );

		// Prepare the callback
		wp.media.editor.send.attachment = function( props, attachment ) {
			$input.val( attachment.url );
			$preview_image.attr( 'src', attachment.url );
			$preview.hide().fadeIn( 300 );
		};

		// Open the media manager
		wp.media.editor.open();

	} );

	// Media upload clear button
	$( '.clientside-media-select-clear-button' ).on( 'click', function( e ) {
		e.preventDefault();
		$( this ).siblings( '.clientside-form-image-input' ).first().val( '' );
		$( this ).siblings( '.clientside-form-image-preview' ).hide();
	} );

	/* 11.0 Main menu */

	// Submenu click toggle
	function toggle_submenu( element ) {
		var $menu_a = $( element );
		var $menu_li = $menu_a.parents( 'li' );
		$menu_li.toggleClass( 'open' );
	}

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		// Toggle menu close on overlay click
		

		// Custom class injection on collapse/expand buttons
		$( '#collapse-menu #collapse-button' ).on( 'click', function( e ) {
			$body.toggleClass( 'clientside-menu-toggled' );
		} );

		// Throttled resize event
		var throttle = false;
		$window.on( 'resize', function() {
			if ( throttle ) {
				clearTimeout( throttle );
			}
			throttle = setTimeout( function() {

				// Reset menu collapse/expand status on resize
				$body.removeClass( 'clientside-menu-toggled' );

				// Close open submenus (because popouts state/positioning can change)
				$( '#adminmenu > li.open' ).removeClass( 'open' );

			}, 100 );
		} );

		// Event: Relay custom menu collapse button click to original collapse button
		$( '#toplevel_page_clientside-menu-collapse > a, #wp-admin-bar-clientside-menu-expand' ).on( 'click', function( e ) {

			e.preventDefault();

			// Toggle sidebar menu
			$( '#collapse-menu #collapse-button' ).trigger( 'click' );

			// Don't stay focussed
			$( this ).blur();

		} );

		// Keyboard: Toggle menu on Cmd+\ / Ctrl+\
		$window.on( 'keydown', function( e ) {
			if ( ( e.metaKey || e.ctrlKey ) && e.keyCode === 220 ) {
				$( '#collapse-menu #collapse-button' ).trigger( 'click' );
			}
		} );

		// Toggle submenu on click / space/enter keys
		$( '.wp-has-submenu > a' )
			// Toggle submenu on keypress
			.on( 'keydown', function( e ) {
				if ( e.keyCode === 32 || e.keyCode === 13 ) { // Space or Enter
					if ( $body.hasClass( 'clientside-inline-submenus' ) || $window.innerWidth() < ( $( '#adminmenuwrap' ).innerWidth() * 2 ) ) {
						e.preventDefault();
						toggle_submenu( this );
					}
				}
			} )
			// Toggle submenu on click
			.on( 'click', function( e ) {
				if ( $body.hasClass( 'clientside-inline-submenus' ) || $window.innerWidth() < ( $( '#adminmenuwrap' ).innerWidth() * 2 ) ) {
					e.preventDefault();
					toggle_submenu( this );
					$( this ).blur();
				}
			} );

		// Prevent :focus status when clicking a main menu item as this keeps the (popout) submenu open (does allow for keyboard focus)
		$document.on( 'click', '#adminmenu > li > a', function( e ) {
			$( this ).blur();
		} );

		// Remove native WP mobile menu functionality (adding .select to main items, ?)
		$( '#adminmenu' ).data( 'wp-responsive', false );

		// Position the popout submenus relative to their main items
		//todo Hide popover on menu scroll
		$( 'li.wp-has-submenu' ).on( 'mouseenter', function( e ) {

			// If circumstances are right
			if ( $body.hasClass( 'clientside-menu-hover-expand' ) && $window.innerWidth() >= $( '#adminmenuwrap' ).innerWidth() * 2 ) {

				var $li = $( this );
				var $submenu = $li.children( '.wp-submenu' );
				var submenu_height = $submenu.outerHeight();
				var parent_top = $li.position().top; // Distance between the top of the main item and the top of the submenu (submenu lower = positive value, submenu higher = negative value)
				var window_height = $window.innerHeight(); //todo cache these values on resize throttle
				var bleed = ( parent_top + submenu_height ) > window_height;

				// Submenu simply won't fit. Switch to inline
				//if ( submenu_height > window_height ) {
				//	$body.removeClass( 'clientside-menu-hover-expand' ).addClass( 'clientside-inline-submenus' );
				//}
				//else {

					// Regular position
					if ( ! bleed ) {
						$submenu.removeClass( '-up' ).css( { top: parent_top } );
					}

					// Bottom aligned
					if ( bleed ) {
						$submenu.addClass( '-up' ).css( { top: parent_top - submenu_height } );
					}

				//}

			}

		} );

	}

	/* 12.0 Conditional highlighting of elements */

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		// Highlight the quick-draft save button when the form is edited
		$( '.clientside-theme #dashboard_quick_press' ).on( 'change keyup', ':input:not([type="submit"])', function() {

			var $button = $( '#save-post' );
			if ( $( '#title' ).val() || $( '#content' ).val() ) {
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$button.removeClass( 'clientside-button-highlighted' );
			}

		} );

		// Highlight the Bulk Action input & submit button when an action is selected
		$( '.clientside-theme .bulkactions' ).on( 'change', 'select', function() {

			var $select = $( this );
			var $button = $select.siblings( '.button' );
			if ( $select.val() !== '-1' ) {
				$select.addClass( 'clientside-input-changed' );
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$select.removeClass( 'clientside-input-changed' );
				$button.removeClass( 'clientside-button-highlighted' );
			}

		} );

		// Highlight the Media filter input & submit button when an action is selected
		//todo Does this apply on first load?
		$( '.clientside-theme .filter-items select' ).on( 'change', function() {

			var $selects = $( this ).parents( '.filter-items' ).find( 'select' );
			var $select = $( this );
			var $button = $select.next( '.actions' ).length ? $select.next( '.actions' ).children( '.button' ) : $select.siblings( '.button' );
			var vals = '0';

			// Input states
			if ( $select.val() && $select.val() !== '0' && $select.val() !== '-1' ) {
				$select.addClass( 'clientside-input-changed' );
			}
			else {
				$select.removeClass( 'clientside-input-changed' );
			}

			// Button state
			$selects.each( function( i ) {
				var $select = $( this );
				if ( $select.val() !== '0' && $select.val() !== '-1' && $select.val() !== '' ) {
					vals += '1';
				}
			} );
			if ( vals !== '0' ) {
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$button.removeClass( 'clientside-button-highlighted' );
			}

		} ).trigger( 'change' );

		// Highlight the Post/Page/CPT filter submit button when filter criteria is selected
		//todo Active state after filtered reload
		$( '.clientside-theme .tablenav .bulkactions + .actions' ).on( 'change', 'select', function() {

			var $select = $( this );
			var $selects = $select.add( $select.siblings( 'select' ) );
			var $button = $select.siblings( '.button' );
			var vals = '0';

			// Input states
			if ( $select.val() && $select.val() !== '0' && $select.val() !== '-1' ) {
				$select.addClass( 'clientside-input-changed' );
			}
			else {
				$select.removeClass( 'clientside-input-changed' );
			}

			// Button state
			$selects.each( function( i ) {
				var $select = $( this );
				if ( $select.val() !== '0' && $select.val() !== '-1' && $select.val() !== '' ) {
					vals += '1';
				}
			} );
			if ( vals !== '0' ) {
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$button.removeClass( 'clientside-button-highlighted' );
			}

		} );

		// Highlight the Search Box button when a string is entered
		/*
		$( '.clientside-theme .search-box' ).on( 'change keyup blur', '[type="search"]', function() {
			var $input = $( this );
			var $button = $input.siblings( '.button' );
			if ( $input.val() ) {
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$button.removeClass( 'clientside-button-highlighted' );
			}
		} );
		*/

		// Highlight theme/plugin editor documentation when interacted with
		$( '.clientside-theme #documentation' ).on( 'change', 'select', function() {

			var $select = $( this );
			var $button = $select.siblings( '.button' );
			if ( $select.val() ) {
				$select.addClass( 'clientside-input-changed' );
				$button.addClass( 'clientside-button-highlighted' );
			}
			else {
				$select.removeClass( 'clientside-input-changed' );
				$button.removeClass( 'clientside-button-highlighted' );
			}

		} );

	}

	/* 13.0 Add global back-to-top button */

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		// Add back-to-top link
		if ( $document.height() > ( $window.height() * 1.5 ) ) {
			$( '<a href="#top" data-scrollto class="clientside-back-to-top">' + clientside.L10n.backToTop + '</a>' )
				.appendTo( $body )
				.on( 'click', function() {
					$( this ).blur();
				} );
			//$body.addClass( 'clientside-backtotop-showing' );
		}

	}

	/* 14.0 Animating scroll triggers */

	// Scroll the page with animation
	function scrollto( y_position ) {
		y_position = y_position || 0;
		y_position = y_position < 0 ? 0 : y_position;
		$( 'html, body' ).stop().animate( { scrollTop: y_position }, 600 );
	}

	// Capture clicks on on-page hash links and trigger an animated scroll
	$( '[data-scrollto]' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );
		var $target;

		if ( href === '#top' ) {
			$target = $( 'body' );
		}

		// Check if element with target #id exists
		else {
			$target = $( href );
		}

		// Check if element with name="id" exists
		if ( ! $target.length ) {
			$target = $( '[name="' + href.replace( '#', '' ) + '"]' );
		}

		// Only perform the animation if an HTML target exists
		if ( $target.length ) {
			e.preventDefault();
			scrollto( $target.offset().top - 100 );
		}

	} );

	// Relay a click to another element (generic)
	$( '[data-js-relay]' ).on( 'click', function( e ) {
		var $this = $( this );
		var $target = $( $this.data( 'js-relay' ) );
		if ( $target.length ) {
			$target.trigger( 'click' );
		}
	} );

	/* 15.0 Add warning when navigating away when theme/plugin editor is used */

	$( '#template #newcontent, .tools_page_clientside-custom-cssjs-tool .clientside-textarea-code' ).one( 'change', function() {
		// Browser warning when navigating away without saving changes
		window.onbeforeunload = function() {
			return clientside.L10n.saveAlert;
		};
	} );

	// Remove warning when submit button is clicked
	$( '#template #submit, .clientside-custom-cssjs-save-button').on( 'click', function() {
		window.onbeforeunload = null;
	} );

	/* 16.0 Add a .wrap to (plugin) pages that don't have one */

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		if ( ! $( '.wrap' ).length ) {
			if ( ! $body.hasClass( 'gutenberg-editor-page' ) && ! $body.hasClass( 'block-editor-page' ) ) {
				$( '#wpbody-content' ).wrapInner( '<div class="wrap" />' );
				$( '#screen-meta-links' ).insertBefore( $( '#wpbody-content > .wrap' ) );
			}
		}

	}

	/* 17.0 Notification Center */

	if ( clientside.clientsideEnabled && $body.hasClass( 'clientside-notification-center' ) && ! clientside.isMobile ) {

		var $toolbar_item = $( '#wp-admin-bar-clientside-notification-center' );
		var $submenu = $toolbar_item.find( '.ab-submenu' );
		var notification_count = 0;
		var important_flag = false;
		var alert_classes = '.update-nag, .notice, .notice-success, .updated, .settings-error, .error, .notice-error, .notice-warning, .notice-info';
		var $alerts = $( alert_classes )
			.not( '.inline, .theme-update-message, .hidden, .hide-if-js' )
			// Plugin exceptions
			// Also see _theme-alerts.scss
			.not( '#gadwp-notice, .rs-update-notice-wrap' );
		var greens = [ 'updated', 'notice-success' ];
		var reds = [ 'error', 'notice-error', 'settings-error' ];
		var blues = [ 'update-nag', 'notice', 'notice-info', 'update-nag', 'notice-warning' ];

		// Itirate page alerts to analyse & copy to the toolbar
		$alerts.each( function( i ) {

			var $alert = $( this );
			//var content = $alert.html();

			// Strip content whitespace
			// content = content.replace( /^\s+|\s+$/g, '' );

			// Skip if alert is empty
			if ( ! $alert.html().replace( /^\s+|\s+$/g, '' ).length ) {
				return true;
			}

			// Determine the priority
			var j;
			var priority = 'neutral';
			// Red
			for ( j = 0; j < reds.length; j += 1 ) {
				if ( $alert.hasClass( reds[ j ] ) ) {
					if ( ! $alert.hasClass( 'updated' ) ) { // Because of .settings-error.updated
						priority = 'red';
						// Color toolbar icon red if it contains important/error notifications
						if ( ! important_flag ) {
							$toolbar_item.addClass( '-important' );
							important_flag = true;
						}
					}
				}
			}

			// Add it to the notification list
			var $new_item = $( '<li><div class="ab-item ab-empty-item clientside-notification-center-item--' + priority + '"></div></li>' ).appendTo( $submenu );
			$alert.clone( true, true ).removeClass( alert_classes.replace( /,|\./g, '' ) ).appendTo( $new_item.children( 'div' ) );
			notification_count += 1;

		} );

		// Populate the counter
		$( '.clientside-notification-count' ).text( notification_count );

		// Show the toolbar item
		if ( notification_count ) {
			$alerts.remove(); // Make sure they don't cause extra spacing by breaking "+" selectors
			$toolbar_item.fadeIn();
		}

	}

	/* 18.0 Import/export functionality */

	// Manage Import button state
	$( '.clientside-import-textarea' ).on( 'keydown keyup change', function( e ) {
		if ( $( this ).val() ) {
			$( '.clientside-import-button' ).prop( 'disabled', false );
		}
		else {
			$( '.clientside-import-button' ).prop( 'disabled', true );
		}
	} );

	// Output serialized options in export box
	$( '.clientside-export-button' ).on( 'click', function( e ) {

		e.preventDefault();
		var $status = $( '.clientside-export-status' ).show().html( clientside.L10n.exportLoading );
		var $export = $( '.clientside-export-textarea' );
		var $result = $( '.clientside-export-result' ).hide();
		var $button = $( '.clientside-export-button' ).prop( 'disabled', true );
		var data = {
			action: 'clientside-get-export',
			sections: []
		};

		// Prepare requested sections
		if ( $( '#clientside-export-checkbox-options' ).prop( 'checked' ) ) {
			data.sections.push( 'options' );
		}
		if ( $( '#clientside-export-checkbox-menu-editor' ).prop( 'checked' ) ) {
			data.sections.push( 'menu-editor' );
		}
		if ( $( '#clientside-export-checkbox-widget-manager' ).prop( 'checked' ) ) {
			data.sections.push( 'widget-manager' );
		}
		if ( $( '#clientside-export-checkbox-column-manager' ).prop( 'checked' ) ) {
			data.sections.push( 'column-manager' );
		}
		if ( $( '#clientside-export-checkbox-custom-cssjs' ).prop( 'checked' ) ) {
			data.sections.push( 'custom-cssjs' );
		}

		// Request export string
		$.ajax( ajaxurl, {
			data: data,
			error: function() {
				$export.val( '' );
				$status.show().html( 'That seems to be an invalid request.' );
			},
			success: function( result ) {
				$export.val( result );
				$status.hide();
			},
			complete: function() {
				$result.show();
				$button.prop( 'disabled', false );
			}
		} );

	} );

	/* 19.0 Insert tab character on tab keypress in code textarea */

	if ( clientside.clientsideEnabled ) {

		$( '.clientside-textarea-code' ).on( 'keydown', function( e ) {

			if ( e.keyCode === 9 ) {

				e.preventDefault();
				var $code = $( this );
				var content = $code.val();
				var selection_start = this.selectionStart;
				var selection_end = this.selectionEnd;

				// Replace textarea content with text before caret + tab + text after caret
				$code.val( content.substring( 0, selection_start ) + '\t' + content.substring( selection_end ) );

				// Place caret
				this.selectionStart = selection_start + 1;
				this.selectionEnd = selection_start + 1;

			}

		} );

	}

	/* 20.0 Post table row overlay */

	var $tableform;

	if ( clientside.clientsideEnabled && clientside.themeEnabled && clientside.tableRowCollapse && ! clientside.isMobile ) {

		// If we're on a table page
		$tableform = $( '.row-actions' ).parents( '.wp-list-table' ).parents( 'form' );
		if ( $tableform.length ) {
			var button_height = 32;
			var overlay_padding_max = 30;
			var overlay_cell = '<th class="clientside-row-actions-cell"></th>';

			// Create the table row overlay
			var create_overlays = function() {

				var $trs = $tableform.find( 'tr' );
				var $tr = $tableform.find( '.row-actions' ).parents( 'tr' ).filter( ':visible' );
				var trs_width = $tr.width();
				var trs_height = $tr.height();

				$.each( $trs, function() {

					var $tr = $( this );
					var $overlay_cell = $tr.children( '.clientside-row-actions-cell' );
					var has_cell = $overlay_cell.length;
						$overlay_cell = has_cell ? $overlay_cell : $( overlay_cell );

					if ( $tr.find( '.row-actions' ).length && ! $overlay_cell.children( '.clientside-row-actions' ).length ) {

						var $pl_up_tr = $tr.next( '.plugin-update-tr' );
						if ( $pl_up_tr.length && ! $pl_up_tr.children( '.clientside-row-actions-cell' ).length ) {
							$pl_up_tr.prepend( overlay_cell );
						}

						var tr_height = $pl_up_tr.length ? trs_height + $pl_up_tr.height() - 1 : trs_height;
						var overlay_padding_v = ( tr_height - button_height ) / 2;
						var overlay_padding_h = overlay_padding_v > overlay_padding_max ? overlay_padding_max : overlay_padding_v;
						var overlay_minheight = ( $pl_up_tr.length ? tr_height : 0 );

						var $overlay = $( '<div class="clientside-row-actions"></div>' ).css( { width: trs_width, padding: overlay_padding_v, paddingRight: overlay_padding_h, paddingLeft: overlay_padding_h, minHeight: overlay_minheight } ).data( { width: trs_width, height: tr_height } );
						$tr.find( '.toggle-row' ).first().clone( true ).appendTo( $overlay );
						$tr.find( '.row-actions' ).first().clone( true ).appendTo( $overlay );
						$overlay.appendTo( $overlay_cell );

					}

					if ( ! has_cell ) {
						$overlay_cell.prependTo( $tr );
					}

				} );

			};
			create_overlays();

			// Row hover event
			$tableform.on( 'mouseenter', 'tr', function() {

				var $tr = $( this );
				if ( ! $tr.find( '.row-actions' ).length ) {
					return;
				}
				if ( $tr.hasClass( 'is-expanded' ) ) {
					return;
				}
				var $pl_up_tr = $tr.next( '.plugin-update-tr' );

				// Recreate the overlay if necessary (in case of ajax refresh)
				var $overlay = $tr.find( '.clientside-row-actions' );
				if ( ! $overlay.length ) {
					create_overlays();
					$overlay = $tr.find( '.clientside-row-actions' );
				}

				// Reset its dimensions and padding if different from before
				var tr_width = $tr.width();
				var tr_height = $pl_up_tr.length ? $tr.height() + $pl_up_tr.height() - 1 : $tr.height();
				var overlay_width = $overlay.data( 'width' );
				var overlay_height = $overlay.data( 'height' );
				if ( tr_width !== overlay_width || tr_height !== overlay_height ) {
					var overlay_padding_v = ( tr_height - button_height ) / 2;
					var overlay_padding_h = overlay_padding_v > overlay_padding_max ? overlay_padding_max : overlay_padding_v;
					var overlay_minheight = $pl_up_tr.length ? tr_height : 0;
					$overlay.css( { width: tr_width, padding: overlay_padding_v, paddingRight: overlay_padding_h, paddingLeft: overlay_padding_h, minHeight: overlay_minheight } ).data( { width: tr_width, height: tr_height } );
				}

			} );

			// Also add the custom table cell to each row inserted by ajax
			$.ajaxSetup( {
				dataFilter: function( response, type ) {
					return response.replace( /<th scope="row"/g, '<th class="clientside-row-actions-cell"></th><th scope="row"' );
				}
			} );

			// Re-apply toggle-row click event after ajax refreshes (plugin table search)
			//todo Not on heartbeat
			$document.ajaxComplete( function( e, jqXHR, ajaxOptions ) {
				$( 'tbody' )
					.off( 'click', '.toggle-row' )
					.on( 'click', '.toggle-row', function() {
						$( this ).closest( 'tr' ).toggleClass( 'is-expanded' );
					} );
			} );

			// Relay plugin update button click in overlay to button in update message
			$tableform.on( 'click', '.clientside-row-actions .clientside-update-plugin a', function( e ) {
				var $trigger = $( this );
				var $target = $trigger.parents( 'tr' ).next( '.plugin-update-tr' ).find( '.update-link' ).last();
				if ( $target.length ) {
					e.preventDefault();
					$target.trigger( 'click' );
					$trigger.parent().animate( { width: 0, opacity: 0 }, 250, function() {
						$trigger.parents( 'tr' ).find( '.clientside-update-plugin' ).remove();
					} ).css( { overflow: 'visible' } );
					// Trigger a fresh mouseover event to cause an overlay resize
					$trigger.parents( 'tr' ).trigger( 'mouseenter' );
				}
			} );

		}

	}

	/* 20.1 Post table selected row state */

	if ( clientside.clientsideEnabled && clientside.themeEnabled ) {

		$tableform = $tableform && $tableform.length ? $tableform : $( '.row-actions' ).parents( 'form' );
		if ( $tableform.length ) {
			$tableform.on( 'change', '.check-column [type="checkbox"]', function() {

				var $checkbox = $( this );
				var checked = $checkbox.prop( 'checked' );
				var $tr;

				// Concerning a single row
				if ( $checkbox.parents( 'tbody' ).length ) {
					$tr = $checkbox.parents( 'tr' );
				}

				// Concerning all rows
				else {
					$tr = $tableform.find( 'tr' );
				}

				// Toggle the state
				if ( checked ) {
					$tr.addClass( 'clientside-is-selected' );
				}
				else {
					$tr.removeClass( 'clientside-is-selected' );
				}

			} );
		}

	}

	/* 21.0 User role checkboxes toggle */

	// Toggle change event
	$( '.clientside-user-role-toggle' ).on( 'change', 'input', function() {
		var $checkbox = $( this );
		var $roles = $checkbox.parent().siblings();
		var state = $checkbox.prop( 'checked' );
		$checkbox.removeClass( 'clientside-checkbox-is-partially-checked' );
		$roles.find( 'input' ).not( ':disabled' ).prop( 'checked', state );
	} );

	// Expand link click event
	$( '.clientside-user-role-toggle' ).on( 'click', 'a', function( e ) {
		e.preventDefault();
		$( this ).parents( '.clientside-user-role-toggle' ).siblings().toggle();
	} );

	/* 22.0 Tax term creation form placeholders / information tooltips */

	$( '#addtag input, #addtag textarea, #addtag select' ).each( function( i ) {
		var $input = $( this );
		var $label = $input.prev( 'label' );
		var $description = $input.next( 'p' );
		//if ( $label.length ) {
		//	$input.attr( 'placeholder', $label.text() );
		//}
		if ( $label.length && $description.length ) {
			var $label_wrap = $label.wrap( '<div class="clientside-form-table-hint-wrapper">' ).parent();
			$( '<span class="clientside-form-table-hint-icon"><span class="dashicons dashicons-editor-help"></span><span class="clientside-form-table-hint-tooltip">' + $description.text() + '</span></span>' ).appendTo( $label_wrap );
		}
	} );

	/* 23.0 Manage tinymce editor toolbar fixed position */
	// Note that this is only applied to the main editor (not additional/ACF editors)

	if ( ! $body.hasClass( 'mobile' ) && $( '#wp-content-editor-container' ).length ) {

		var $editor_toolbars = $( '#wp-content-editor-container #ed_toolbar, #wp-content-editor-container .mce-toolbar-grp' );
		var top_stick_trigger = 0;
		var max_stick_trigger = 0;

		if ( $editor_toolbars.length ) {
			top_stick_trigger = parseInt( $editor_toolbars.offset().top, 10 );
			max_stick_trigger = top_stick_trigger + 100;
		}

		$document.on( 'tinymce-editor-init', function( e, editor ) {
			var $tinymce_toolbar = $( '#wp-content-editor-container .mce-toolbar-grp' );
			if ( $tinymce_toolbar.length ) {
				$editor_toolbars = $editor_toolbars.add( $tinymce_toolbar );
				top_stick_trigger = parseInt( $tinymce_toolbar.offset().top, 10 );
				max_stick_trigger = top_stick_trigger + 100;
				$window.trigger( 'scroll' );
			}
		} );

		//- $window.on( 'clientside-on-scroll', function() {
		$window.on( 'scroll', function() {

			var scrolltop = $window.scrollTop();

			if ( ! $editor_toolbars.length ) {
				return;
			}

			if ( scrolltop > top_stick_trigger && scrolltop < max_stick_trigger ) {
				$editor_toolbars.addClass( '-fixed' );
				$editor_toolbars.removeClass( '-top' );
			}
			else if ( scrolltop > max_stick_trigger ) {
				$editor_toolbars.removeClass( '-fixed -top' );
			}
			else {
				$editor_toolbars.addClass( '-top' );
				$editor_toolbars.removeClass( '-fixed' );
			}

		} );

	}

	

	

} );
