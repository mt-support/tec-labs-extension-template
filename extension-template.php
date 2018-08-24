<?php
/**
 * Plugin Name:       [Base Plugin Name] Extension: [Extension Name]
 * Plugin URI:        https://theeventscalendar.com/extensions/---the-extension-article-url---/
 * GitHub Plugin URI: https://github.com/mt-support/extension-template/
 * Description:       [Extension Description]
 * Version:           1.0.0
 * Extension Class:   Tribe__Extension__Example
 * Author:            Modern Tribe, Inc.
 * Author URI:        http://m.tri.be/1971
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       match-the-plugin-directory-name
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

// Do not load unless Tribe Common is fully loaded and our class does not yet exist.
if (
	class_exists( 'Tribe__Extension' )
	&& ! class_exists( 'Tribe__Extension__Example' )
) {
	/**
	 * Extension main class, class begins loading on init() function.
	 */
	class Tribe__Extension__Example extends Tribe__Extension {

		/**
		 * Setup the Extension's properties.
		 *
		 * This always executes even if the required plugins are not present.
		 */
		public function construct() {
			// Requirements and other properties such as the extension homepage can be defined here.
			// Examples:
			// $this->add_required_plugin( 'Tribe__Events__Main', '4.3' );
		}

		/**
		 * Extension initialization and hooks.
		 */
		public function init() {
			// Load plugin textdomain
			// Don't forget to generate the 'languages/match-the-plugin-directory-name.pot' file
			load_plugin_textdomain( 'match-the-plugin-directory-name', false, basename( dirname( __FILE__ ) ) . '/languages/' );

			/**
			 * Protect against fatals by specifying the required minimum PHP
			 * version. Make sure to match the readme.txt header.
			 * All extensions require PHP 5.6+, following along with https://theeventscalendar.com/knowledgebase/php-version-requirement-changes/
			 *
			 * Delete this paragraph and the non-applicable comments below.
			 *
			 * Note that older version syntax errors may still throw fatals even
			 * if you implement this PHP version checking so QA it at least once.
			 *
			 * @link https://secure.php.net/manual/en/migration56.new-features.php
			 * 5.6: Variadic Functions, Argument Unpacking, and Constant Expressions
			 *
			 * @link https://secure.php.net/manual/en/migration70.new-features.php
			 * 7.0: Return Types, Scalar Type Hints, Spaceship Operator, Constant Arrays Using define(), Anonymous Classes, intdiv(), and preg_replace_callback_array()
			 *
			 * @link https://secure.php.net/manual/en/migration71.new-features.php
			 * 7.1: Class Constant Visibility, Nullable Types, Multiple Exceptions per Catch Block, `iterable` Pseudo-Type, and Negative String Offsets
			 *
			 * @link https://secure.php.net/manual/en/migration72.new-features.php
			 * 7.2: `object` Parameter and Covariant Return Typing, Abstract Function Override, and Allow Trailing Comma for Grouped Namespaces
			 */
			$php_required_version = '5.6';

			if ( version_compare( PHP_VERSION, $php_required_version, '<' ) ) {
				if (
					is_admin()
					&& current_user_can( 'activate_plugins' )
				) {
					$message = '<p>';

					$message .= sprintf( __( '%s requires PHP version %s or newer to work. Please contact your website host and inquire about updating PHP.', 'match-the-plugin-directory-name' ), $this->get_name(), $php_required_version );

					$message .= sprintf( ' <a href="%1$s">%1$s</a>', 'https://wordpress.org/about/requirements/' );

					$message .= '</p>';

					tribe_notice( $this->get_name(), $message, 'type=error' );
				}

				return;
			}

			// Insert filters and hooks here
			add_filter( 'thing_we_are_filtering', array( $this, 'my_custom_function' ) );
		}

		/**
		 * Include a docblock for every class method and property.
		 */
		public function my_custom_function() {
			// custom stuff
		}

	} // end class
} // end if class_exists check
