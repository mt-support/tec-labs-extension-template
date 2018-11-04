<?php

namespace Tribe\Extensions\Example;

if ( ! class_exists( 'Settings' ) ) {
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
		 * @var string
		 */
		protected $opts_prefix = 'tribe_ext_example_';

		/**
		 * Settings constructor.
		 *
		 * TODO: Update this entire class for your needs, or remove the entire `src` directory this file is in and do not load it in the main plugin file.
		 */
		public function __construct() {
			$this->settings_helper = new Settings_Helper();

			// Remove settings specific to Google Maps
			add_action( 'admin_init', [ $this, 'remove_settings' ] );

			// Add settings specific to OSM
			add_action( 'admin_init', [ $this, 'add_settings' ] );
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
		 * Here is an example of getting some HTML for the Settings Header.
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

		/**
		 * Adds the setting field to Events > Settings > General tab
		 * The setting will appear above the "End of day cutoff" setting
		 * (below the "Single event URL slug" setting)
		 */
		public function add_settings() {
			$fields = [
				$this->opts_prefix . 'Example'  => [
					'type' => 'html',
					'html' => $this->get_example_intro_text(),
				],
				$this->opts_prefix . 'a_setting' => [ // TODO
					'type'            => 'text',
					'label'           => esc_html__( 'xxx try this', PLUGIN_TEXT_DOMAIN ),
					'tooltip'         => sprintf( esc_html__( 'Enter your custom URL, including "http://" or "https://", for example %s.', PLUGIN_TEXT_DOMAIN ), '<code>https://mydomain.com/events/</code>' ),
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

	} // class
} // class_exists
