<?php
/**
 * Handles the update functionality of the plugin.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__;
 */

namespace Tribe\Extensions\__TRIBE_NAMESPACE__;

use Tribe__PUE__Checker;

/**
 * Class PUE.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__;
 */
class PUE extends \tad_DI52_ServiceProvider {

	/**
	 * The slug used for PUE.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	private static $pue_slug = 'extension-__TRIBE_SLUG__';

	/**
	 * Whether to load PUE or not.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	public static $is_active = false;

	/**
	 * Plugin update URL.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	private $update_url = 'http://tri.be/';

	/**
	 * The PUE checker instance.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var Tribe__PUE__Checker
	 */
	private $pue_instance;

	/**
	 * Registers the filters required by the Plugin Update Engine.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function register() {
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__.pue', $this );

		// Bail to avoid notice.
		if ( ! static:: $is_active ) {
			return;
		}

		add_action( 'tribe_helper_activation_complete', [ $this, 'load_plugin_update_engine' ] );

		register_uninstall_hook( Plugin::FILE, [ static::class, 'uninstall' ] );
	}

	/**
	 * If the PUE Checker class exists, go ahead and create a new instance to handle
	 * update checks for this plugin.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function load_plugin_update_engine() {
		/**
		 * Filters whether Extension exists on PUE component should manage the plugin updates or not.
		 *
		 * @since __TRIBE_VERSION__
		 *
		 * @param bool   $pue_enabled Whether PUE component should manage the plugin updates or not.
		 * @param string $pue_slug    The plugin slug used to register it in the Plugin Update Engine.
		 */
		$pue_enabled = apply_filters( 'tribe_enable_pue', true, static::get_slug() );

		if ( ! ( $pue_enabled && class_exists( 'Tribe__PUE__Checker' ) ) ) {
			return;
		}

		$this->pue_instance = new Tribe__PUE__Checker(
			$this->update_url,
			static::get_slug(),
			[],
			plugin_basename( Plugin::FILE )
		);
	}

	/**
	 * Get the PUE slug for this plugin.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @return string PUE slug.
	 */
	public static function get_slug() {
		return static::$pue_slug;
	}

	/**
	 * Handles the removal of PUE-related options when the plugin is uninstalled.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public static function uninstall() {
		$slug = str_replace( '-', '_', static::get_slug() );

		delete_option( 'pue_install_key_' . $slug );
		delete_option( 'pu_dismissed_upgrade_' . $slug );
	}
}
