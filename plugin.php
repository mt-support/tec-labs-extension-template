<?php
/**
 * Plugin Name:       __TRIBE_BASE__ Extension: __TRIBE_NAME__
 * Plugin URI:        __TRIBE_URL__
 * GitHub Plugin URI: https://github.com/mt-support/tribe-ext-__TRIBE_SLUG__
 * Description:       __TRIBE_DESCRIPTION__
 * Version:           __TRIBE_VERSION__
 * Author:            Modern Tribe, Inc.
 * Author URI:        http://m.tri.be/1971
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       __TRIBE_SLUG__
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
	// When we dont have autoloader from common we bail.
	if  ( ! class_exists( 'Tribe__Autoloader' ) ) {
		return;
	}

	// Register the namespace so we can the plugin on the service provider registration.
	Tribe__Autoloader::instance()->register_prefix(
		'\\Tribe\\Extensions\\__TRIBE_NAMESPACE__\\',
		__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Tribe',
		'__TRIBE_SLUG__'
	);

	tribe_register_provider( '\Tribe\Extensions\__TRIBE_NAMESPACE__\Plugin' );
}

// Loads after common is already properly loaded.
add_action( 'tribe_common_loaded', 'tribe_extension___TRIBE_SLUG_CLEAN__' );