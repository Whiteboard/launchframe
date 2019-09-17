<?php
/*
 * Clientside Admin Column Manager class
 * Contains method to build the Admin Column Manager tool and perform the role-based hiding of columns
 * //todo Ignore role-specific config if the user role is disabled in the tool (for when the role does get the capability assigned)
 */

class Clientside_Admin_Column_Manager {

	// Return (array) list of admin column slugs for a specified page, optionally with a prefix
	static function get_column_slugs( $page_slug = 'posts', $prefix = 'admin-column-manager-posts-' ) {

		$columns = self::get_column_info( $page_slug );
		$column_slugs = array();

		foreach ( $columns as $column_slug => $column_info ) {
			$column_slugs[] = $prefix . $column_slug;
		}

		return $column_slugs;

	}

	// Return (string) page name to display as option section title
	static function get_page_name( $page_slug = 'posts' ) {

		$page_names = array(
			'posts' => __( 'Posts' ),
			'pages' => __( 'Pages' ),
			'media' => __( 'Media' ),
			'users' => __( 'Users' ),
			'woocommerce-products' => __( 'WooCommerce products', 'clientside' ),
			'woocommerce-orders' => __( 'WooCommerce orders', 'clientside' ),
			'woocommerce-coupons' => __( 'WooCommerce coupons', 'clientside' )
		);

		// Return
		return isset( $page_names[ $page_slug ] ) ? $page_names[ $page_slug ] : '';

	}

	// Return (array) all manageble admin columns' info
	static function get_column_info( $page = '' ) {

		$columns = array(
			'posts' => array(
				'author' => array(
					'field' => array(
						'name' => 'admin-column-manager-posts-author',
						'title' => _x( 'Author', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0
						)
					)
				),
				'categories' => array(
					'field' => array(
						'name' => 'admin-column-manager-posts-categories',
						'title' => _x( 'Categories', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0
						)
					)
				),
				'tags' => array(
					'field' => array(
						'name' => 'admin-column-manager-posts-tags',
						'title' => _x( 'Tags', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0
						)
					)
				),
				'comments' => array(
					'field' => array(
						'name' => 'admin-column-manager-posts-comments',
						'title' => _x( 'Comments', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0
						)
					)
				),
				'date' => array(
					'field' => array(
						'name' => 'admin-column-manager-posts-date',
						'title' => _x( 'Date', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0
						)
					)
				)
			),
			'pages' => array(
				'author' => array(
					'field' => array(
						'name' => 'admin-column-manager-pages-author',
						'title' => _x( 'Author', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0
						)
					)
				),
				'comments' => array(
					'field' => array(
						'name' => 'admin-column-manager-pages-comments',
						'title' => _x( 'Comments', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0
						)
					)
				),
				'date' => array(
					'field' => array(
						'name' => 'admin-column-manager-pages-date',
						'title' => _x( 'Date', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0
						)
					)
				)
			),
			'media' => array(
				'icon' => array(
					'field' => array(
						'name' => 'admin-column-manager-media-icon',
						'title' => _x( 'File icon / thumbnail preview', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0
						)
					)
				),
				'author' => array(
					'field' => array(
						'name' => 'admin-column-manager-media-author',
						'title' => _x( 'Author', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0
						)
					)
				),
				'parent' => array(
					'field' => array(
						'name' => 'admin-column-manager-media-parent',
						'title' => _x( 'Uploaded to', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0
						)
					)
				),
				'comments' => array(
					'field' => array(
						'name' => 'admin-column-manager-media-comments',
						'title' => _x( 'Comments', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0
						)
					)
				),
				'date' => array(
					'field' => array(
						'name' => 'admin-column-manager-media-date',
						'title' => _x( 'Date', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0
						)
					)
				)
			),
			'users' => array(
				'username' => array(
					'field' => array(
						'name' => 'admin-column-manager-users-username',
						'help' => __( 'The user\'s username and avatar', 'clientside' ),
						'title' => __( 'Username' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author',
							'editor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0,
							'editor' => 0
						)
					)
				),
				'name' => array(
					'field' => array(
						'name' => 'admin-column-manager-users-name',
						'title' => _x( 'Name', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'help' => __( 'The user\'s full name', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author',
							'editor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0,
							'editor' => 0
						)
					)
				),
				'email' => array(
					'field' => array(
						'name' => 'admin-column-manager-users-email',
						'title' => _x( 'E-mail', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author',
							'editor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0,
							'editor' => 0
						)
					)
				),
				'role' => array(
					'field' => array(
						'name' => 'admin-column-manager-users-role',
						'title' => _x( 'Role', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author',
							'editor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0,
							'editor' => 0
						)
					)
				),
				'posts' => array(
					'field' => array(
						'name' => 'admin-column-manager-users-posts',
						'title' => _x( 'Posts', 'Admin column title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'help' => __( 'The user\'s post count', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'disabled-for' => array(
							'subscriber',
							'contributor',
							'author',
							'editor'
						),
						'default' => array(
							'clientside-default' => 1,
							'subscriber' => 0,
							'contributor' => 0,
							'author' => 0,
							'editor' => 0
						)
					)
				)
			)
		);

		// WooCommerce columns
		if ( class_exists( 'WooCommerce' ) ) {
			$columns['woocommerce-products'] = array(
				'thumb' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-thumb',
						'title' => __( 'Product image', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'name' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-name',
						'title' => __( 'Product title', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'sku' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-sku',
						'title' => __( 'SKU', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'is_in_stock' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-is_in_stock',
						'title' => __( 'Stock', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'price' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-price',
						'title' => __( 'Price', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'product_cat' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-product_cat',
						'title' => __( 'Categories', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'product_tag' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-product_tag',
						'title' => __( 'Tags', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'featured' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-featured',
						'title' => __( 'Featured product', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'product_type' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-product_type',
						'title' => __( 'Product type', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'date' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-products-date',
						'title' => __( 'Date', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				)
			);
			$columns['woocommerce-orders'] = array(
				'order_status' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_status',
						'title' => __( 'Order status', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_title' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_title',
						'title' => __( 'Order', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_items' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_items',
						'title' => __( 'Order items', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'billing_address' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-billing_address',
						'title' => __( 'Billing address', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'shipping_address' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-shipping_address',
						'title' => __( 'Shipping address', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'customer_message' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-customer_message',
						'title' => __( 'Customer message', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_notes' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_notes',
						'title' => __( 'Order notes', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_date' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_date',
						'title' => __( 'Order date', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_total' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_total',
						'title' => __( 'Order total', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'order_actions' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-orders-order_actions',
						'title' => __( 'Order actions', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				)
			);
			$columns['woocommerce-coupons'] = array(
				'coupon_code' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-coupon_code',
						'title' => __( 'Coupon code', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'type' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-type',
						'title' => __( 'Coupon type', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'amount' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-amount',
						'title' => __( 'Coupon value', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'description' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-description',
						'title' => __( 'Description', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'products' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-products',
						'title' => __( 'Product IDs', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'usage' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-usage',
						'title' => __( 'Usage / Limit', 'woocommerce' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
				'expiry_date' => array(
					'field' => array(
						'name' => 'admin-column-manager-woocommerce-coupons-expiry_date',
						'title' => __( 'Expiry date', 'clientside' ),
						'secondary-title' => __( 'Enable for %s', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => true,
						'default' => 1
					)
				),
			);
		}

		// Yoast columns
		if ( defined( 'WPSEO_FILE' ) ) {

			// Yoast: Posts
			$columns['posts']['wpseo-links'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-links',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Internal links', 'clientside' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-score'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-score',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'SEO score', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-score-readability'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-score-readability',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Readability score', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-title'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-title',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'SEO Title', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-metadesc'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-metadesc',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Meta Desc.', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-focuskw'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-focuskw',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Focus KW', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['posts']['wpseo-links'] = array(
				'field' => array(
					'name' => 'admin-column-manager-posts-wpseo-links',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Internal links', 'clientside' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);

			// Yoast: Pages
			$columns['pages']['wpseo-links'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-links',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Internal links', 'clientside' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-score'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-score',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'SEO score', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-score-readability'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-score-readability',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Readability score', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-title'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-title',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'SEO Title', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-metadesc'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-metadesc',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Meta Desc.', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-focuskw'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-focuskw',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Focus KW', 'wordpress-seo' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);
			$columns['pages']['wpseo-links'] = array(
				'field' => array(
					'name' => 'admin-column-manager-pages-wpseo-links',
					'title' => sprintf( __( 'Yoast SEO: %s', 'clientside' ), __( 'Internal links', 'clientside' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			);

		}

		// Return
		if ( $page ) {
			return isset( $columns[ $page ] ) ? $columns[ $page ] : array();
		}
		return $columns;

	}

	// Perform removal of columns depending on config
	static function remove_page_columns( $page = 'posts', $original_columns = array() ) {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-admin-column-manager-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) ) {
			return $original_columns;
		}

		// All applicable columns
		$columns = self::get_column_info( $page );
		foreach ( $columns as $column_slug => $column_info ) {

			// Skip if this column is not in the current column set
			if ( ! isset( $original_columns[ $column_slug ] ) ) {
				continue;
			}

			// Determine wether this column should be enabled/disabled
			// If this tool is network disabled, use the network defaults
			if ( Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) ) {
				$column_is_enabled = Clientside_Options::get_saved_network_default_option( 'admin-column-manager-' . $page . '-' . $column_slug );
			}
			// Use the regular site options
			else {
				$column_is_enabled = Clientside_Options::get_saved_option( 'admin-column-manager-' . $page . '-' . $column_slug );
			}

			// Remove column if role-based option is set to false
			if ( ! $column_is_enabled ) {
				unset( $original_columns[ $column_slug ] );
			}

		}

		// Return
		return $original_columns;

	}

	// Apply the removal of post list columns if applicable to this role / page
	static function filter_remove_posts_columns( $columns ) {
		return self::remove_page_columns( 'posts', $columns );
	}

	// Apply the removal of page list columns if applicable to this role / page
	static function filter_remove_pages_columns( $columns ) {
		return self::remove_page_columns( 'pages', $columns );
	}

	// Apply the removal of user list columns if applicable to this role / page
	static function filter_remove_users_columns( $columns ) {
		return self::remove_page_columns( 'users', $columns );
	}

	// Apply the removal of media list columns if applicable to this role / page
	static function filter_remove_media_columns( $columns ) {
		return self::remove_page_columns( 'media', $columns );
	}

	// Apply the removal of WooCommerce product columns
	static function filter_remove_woocommerce_product_columns( $columns ) {
		return self::remove_page_columns( 'woocommerce-products', $columns );
	}

	// Apply the removal of WooCommerce order columns
	static function filter_remove_woocommerce_order_columns( $columns ) {
		return self::remove_page_columns( 'woocommerce-orders', $columns );
	}

	// Apply the removal of WooCommerce coupon columns
	static function filter_remove_woocommerce_coupon_columns( $columns ) {
		return self::remove_page_columns( 'woocommerce-coupons', $columns );
	}

}
?>
