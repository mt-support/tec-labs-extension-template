<?php
/**
 * Plugin Name:       __TRIBE_BASE__ Extension: __TRIBE_NAME__
 * Plugin URI:        __TRIBE_URL__
 * GitHub Plugin URI: https://github.com/mt-support/tec-labs-__TRIBE_SLUG__
 * Description:       __TRIBE_DESCRIPTION__
 * Version:           __TRIBE_VERSION__
 * Author:            The Events Calendar
 * Author URI:        https://evnt.is/1971
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       __TRIBE_DOMAIN__
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

/**
 * Define the base file that loaded the plugin for determining plugin path and other variables.
 *
 * @since __TRIBE_VERSION__
 *
 * @var string Base file that loaded the plugin.
 */
define( 'TRIBE_EXTENSION___TRIBE_SLUG_CLEAN_UPPERCASE___FILE', __FILE__ );

/**
 * Register and load the service provider for loading the extension.
 *
 * @since __TRIBE_VERSION__
 */
function tribe_extension___TRIBE_SLUG_CLEAN__() {
	// When we don't have autoloader from common we bail.
	if ( ! class_exists( 'Tribe__Autoloader' ) ) {
		return;
	}

	// Register the namespace so we can the plugin on the service provider registration.
	Tribe__Autoloader::instance()->register_prefix(
		'\\Tribe\\Extensions\\__TRIBE_NAMESPACE__\\',
		__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Tec',
		'__TRIBE_SLUG__'
	);

	// Deactivates the plugin in case of the main class didn't autoload.
	if ( ! class_exists( '\Tribe\Extensions\__TRIBE_NAMESPACE__\Plugin' ) ) {
		tribe_transient_notice(
			'__TRIBE_SLUG__',
			'<p>' . esc_html__( 'Couldn\'t properly load "__TRIBE_BASE__ Extension: __TRIBE_NAME__" the extension was deactivated.', '__TRIBE_DOMAIN__' ) . '</p>',
			[],
			// 1 second after that make sure the transient is removed.
			1
		);

		if ( ! function_exists( 'deactivate_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		deactivate_plugins( __FILE__, true );
		return;
	}

	tribe_register_provider( '\Tribe\Extensions\__TRIBE_NAMESPACE__\Plugin' );
}

// Loads after common is already properly loaded.
add_action( 'tribe_common_loaded', 'tribe_extension___TRIBE_SLUG_CLEAN__' );
