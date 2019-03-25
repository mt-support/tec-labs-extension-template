<?php

namespace Tribe\Extensions\Example;

use Tribe__Settings_Manager;

/**
 * Do the Settings.
 */
class Settings {

	/**
	 * The Settings Helper class.
	 *
	 * @var Settings_Helper
	 */
	protected $settings_helper;

	/**
	 * The prefix for our settings keys.
	 *
	 * Gets set automatically from the Text Domain or can be set manually.
	 * The prefix should not end with underscore `_`.
	 *
	 * @var string
	 */
	private $opts_prefix = '';

	/**
	 * Settings constructor.
	 *
	 * TODO: Update this entire class for your needs, or remove the entire `src` directory this file is in and do not load it in the main plugin file.
	 */
	public function __construct( $opts_prefix = '' ) {
		$this->settings_helper = new Settings_Helper();

		$this->set_options_prefix( $opts_prefix );

		// Remove settings specific to Google Maps
		add_action( 'admin_init', [ $this, 'remove_settings' ] );

		// Add settings specific to OSM
		add_action( 'admin_init', [ $this, 'add_settings' ] );
	}

	/**
	 * Set the options prefix to be used for this extension's settings.
	 *
	 * Defaults to the text domain, converting hyphens to underscores.
	 * Always has ends with a single underscore.
	 *
	 * @param string $opts_prefix
	 */
	private function set_options_prefix( $opts_prefix = '' ) {
		if ( empty( $opts_prefix ) ) {
			$opts_prefix = str_replace( '-', '_', PLUGIN_TEXT_DOMAIN );
		}

		$opts_prefix = $opts_prefix . '_';

		$this->opts_prefix = str_replace( '__', '_', $opts_prefix );
	}

	/**
	 * Given an option key, get this extension's option value.
	 *
	 * This automatically prepends this extension's option prefix so you can just do `$this->get_option( 'a_setting' )`.
	 *
	 * @see tribe_get_option()
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function get_option( $key = '', $default = '' ) {
		$key = $this->sanitize_option_key( $key );

		return tribe_get_option( $key, $default );
	}

	/**
	 * Get an option key after ensuring it is appropriately prefixed.
	 *
	 * @param string $key
	 *
	 * @return string
	 */
	private function sanitize_option_key( $key = '' ) {
		$prefix = $this->get_options_prefix();

		if ( 0 === strpos( $key, $prefix ) ) {
			$prefix = '';
		}

		return $prefix . $key;
	}

	/**
	 * Get this extension's options prefix.
	 *
	 * @return string
	 */
	public function get_options_prefix() {
		if ( empty( $this->opts_prefix ) ) {
			$this->set_options_prefix();
		}

		return $this->opts_prefix;
	}

	/**
	 * Get an array of all of this extension's options without array keys having the redundant prefix.
	 *
	 * @return array
	 */
	public function get_all_options() {
		$raw_options = $this->get_all_raw_options();

		$result = [];

		$prefix = $this->get_options_prefix();

		foreach ( $raw_options as $key => $value ) {
			$abbr_key          = str_replace( $prefix, '', $key );
			$result[$abbr_key] = $value;
		}

		return $result;
	}

	/**
	 * Get an array of all of this extension's raw options (i.e. the ones starting with its prefix).
	 *
	 * @return array
	 */
	public function get_all_raw_options() {
		$tribe_options = Tribe__Settings_Manager::get_options();

		if ( ! is_array( $tribe_options ) ) {
			return [];
		}

		$result = [];

		foreach ( $tribe_options as $key => $value ) {
			if ( 0 === strpos( $key, $this->get_options_prefix() ) ) {
				$result[$key] = $value;
			}
		}

		return $result;
	}

	/**
	 * Given an option key, delete this extension's option value.
	 *
	 * This automatically prepends this extension's option prefix so you can just do `$this->delete_option( 'a_setting' )`.
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function delete_option( $key = '' ) {
		$key = $this->sanitize_option_key( $key );

		$options = Tribe__Settings_Manager::get_options();

		unset( $options[$key] );

		return Tribe__Settings_Manager::set_options( $options );
	}

	/**
	 * Here is an example of removing settings from Events > Settings > General tab > "Map Settings" section
	 * that are specific to Google Maps.
	 */
	public function remove_settings() {
		// "Enable Google Maps" checkbox
		$this->settings_helper->remove_field( 'embedGoogleMaps', 'general' );
		// "Map view search distance limit" (default of 25)
		$this->settings_helper->remove_field( 'geoloc_default_geofence', 'general' );
		// "Google Maps default zoom level" (0-21, default of 10)
		$this->settings_helper->remove_field( 'embedGoogleMapsZoom', 'general' );
	}

	/**
	 * Adds a new section of fields to Events > Settings > General tab, appearing after the "Map Settings" section and
	 * before the "Miscellaneous Settings" section.
	 */
	public function add_settings() {
		$fields = [
			// TODO: Settings heading start. Remove this element if not needed. Also remove the corresponding `get_example_intro_text()` method below.
			$this->opts_prefix . 'Example'   => [
				'type' => 'html',
				'html' => $this->get_example_intro_text(),
			],
			// TODO: Settings heading end.
			$this->opts_prefix . 'a_setting' => [ // TODO
				'type'            => 'text',
				'label'           => esc_html__( 'xxx try this', PLUGIN_TEXT_DOMAIN ),
				'tooltip'         => sprintf( esc_html__( 'Enter your custom URL, including "http://" or "https://", for example %s.', PLUGIN_TEXT_DOMAIN ), '<code>https://wpshindig.com/events/</code>' ),
				'validation_type' => 'html',
			]
		];

		$this->settings_helper->add_fields(
			$fields,
			'general',
			'tribeEventsMiscellaneousTitle',
			true
		);
	}

	/**
	 * Here is an example of getting some HTML for the Settings Header.
	 *
	 * TODO: Delete this method if you do not need a heading for your settings. Also remove the corresponding element in the the $fields array in the `add_settings()` method above.
	 *
	 * @return string
	 */
	private function get_example_intro_text() {
		$result = '<h3>' . esc_html_x( 'Example Extension Setup', 'Settings header', PLUGIN_TEXT_DOMAIN ) . '</h3>';
		$result .= '<div style="margin-left: 20px;">';
		$result .= '<p>';
		$result .= esc_html_x( 'Some settings text here', 'Settings', PLUGIN_TEXT_DOMAIN );
		$result .= '</p>';
		$result .= '</div>';

		return $result;
	}

} // class
