<?php
/**
 * Plugin Name:     [Base Plugin Name] Extension: [Extension name]
 * Description:     [Extension Description]
 * Version:         1.0.0
 * Extension Class: Tribe__Extension__[Example]
 * Author:          Modern Tribe, Inc.
 * Author URI:      http://m.tri.be/1971
 * License:         GPLv2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 */

// Do not load unless Tribe Common is fully loaded.
if ( ! class_exists( 'Tribe__Extension' ) ) {
	return;
}

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
		//
		//     $this->add_required_plugin( 'Tribe__Events__Main', '4.3' );
		//     $this->set_url( 'https://theeventscalendar.com/extensions/example/' );
   }

	/**
	 * Extension initialization and hooks.
	 */
	public function init() {
		// Insert custom code here
   }
}