<?php
/**
 * Plugin Class.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 */

namespace Tribe\Extensions\__TRIBE_NAMESPACE__;

/**
 * Class Plugin
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 */
class Plugin extends \tad_DI52_ServiceProvider {
	/**
	 * Stores the version for the plugin.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	const VERSION = '__TRIBE_VERSION__';

	/**
	 * Stores the base slug for the plugin.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	const SLUG = '__TRIBE_SLUG__';

	/**
	 * Stores the base slug for the extension.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @var string
	 */
	const FILE = TRIBE_EXTENSION___TRIBE_SLUG_CLEAN_UPPERCASE___FILE;

	/**
	 * @since __TRIBE_VERSION__
	 *
	 * @var string Plugin Directory.
	 */
	public $plugin_dir;

	/**
	 * @since __TRIBE_VERSION__
	 *
	 * @var string Plugin path.
	 */
	public $plugin_path;

	/**
	 * @since __TRIBE_VERSION__
	 *
	 * @var string Plugin URL.
	 */
	public $plugin_url;

	/**
	 * @since __TRIBE_VERSION__
	 *
	 * @var Settings
	 *
	 * TODO: Remove if not using settings
	 */
	private $settings;

	/**
	 * Setup the Extension's properties.
	 *
	 * This always executes even if the required plugins are not present.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function register() {
		// Set up the plugin provider properties.
		$this->plugin_path = trailingslashit( dirname( static::FILE ) );
		$this->plugin_dir  = trailingslashit( basename( $this->plugin_path ) );
		$this->plugin_url  = plugins_url( $this->plugin_dir, $this->plugin_path );

		// Register this provider as the main one and use a bunch of aliases.
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__', $this );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__.plugin', $this );
		$this->container->register( PUE::class );

		if ( ! $this->check_plugin_dependencies() ) {
			// If the plugin dependency manifest is not met, then bail and stop here.
			return;
		}

		// Do the settings.
		// TODO: Remove if not using settings
		$this->get_settings();

		// Start binds.



		// End binds.

		$this->container->register( Hooks::class );
		$this->container->register( Assets::class );
	}

	/**
	 * Checks whether the plugin dependency manifest is satisfied or not.
	 *
	 * @since __TRIBE_VERSION__
	 *
	 * @return bool Whether the plugin dependency manifest is satisfied or not.
	 */
	protected function check_plugin_dependencies() {
		$this->register_plugin_dependencies();

		return tribe_check_plugin( static::class );
	}

	/**
	 * Registers the plugin and dependency manifest among those managed by Tribe Common.
	 *
	 * @since __TRIBE_VERSION__
	 */
	protected function register_plugin_dependencies() {
		$plugin_register = new Plugin_Register();
		$plugin_register->register_plugin();

		$this->container->singleton( Plugin_Register::class, $plugin_register );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__', $plugin_register );
	}

	/**
	 * Get this plugin's options prefix.
	 *
	 * Settings_Helper will append a trailing underscore before each option.
	 *
	 * @return string
     *
	 * @see \Tribe\Extensions\__TRIBE_NAMESPACE__\Settings::set_options_prefix()
	 *
	 * TODO: Remove if not using settings
	 */
	private function get_options_prefix() {
		return (string) str_replace( '-', '_', 'tribe-ext-__TRIBE_SLUG__' );
	}

	/**
	 * Get Settings instance.
	 *
	 * @return Settings
	 *
	 * TODO: Remove if not using settings
	 */
	private function get_settings() {
		if ( empty( $this->settings ) ) {
			$this->settings = new Settings( $this->get_options_prefix() );
		}

		return $this->settings;
	}

	/**
	 * Get all of this extension's options.
	 *
	 * @return array
	 *
	 * TODO: Remove if not using settings
	 */
	public function get_all_options() {
		$settings = $this->get_settings();

		return $settings->get_all_options();
	}

	/**
	 * Get a specific extension option.
	 *
	 * @param $option
	 * @param string $default
	 *
	 * @return array
	 *
	 * TODO: Remove if not using settings
	 */
	public function get_option( $option, $default = '' ) {
		$settings = $this->get_settings();

		return $settings->get_option( $option, $default );
	}
}
