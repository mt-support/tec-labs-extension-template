<?php
/**
 * Handles hooking all the actions and filters used by the module.
 *
 * To remove a filter:
 * ```php
 *  remove_filter( 'some_filter', [ tribe( Tribe\Extensions\__TRIBE_NAMESPACE__\Hooks::class ), 'some_filtering_method' ] );
 *  remove_filter( 'some_filter', [ tribe( 'extension.__TRIBE_SLUG_CLEAN__.hooks' ), 'some_filtering_method' ] );
 * ```
 *
 * To remove an action:
 * ```php
 *  remove_action( 'some_action', [ tribe( Tribe\Extensions\__TRIBE_NAMESPACE__\Hooks::class ), 'some_method' ] );
 *  remove_action( 'some_action', [ tribe( 'extension.__TRIBE_SLUG_CLEAN__.hooks' ), 'some_method' ] );
 * ```
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__;
 */

namespace Tribe\Extensions\__TRIBE_NAMESPACE__;

use Tribe__Main as Common;

use TEC\Common\Contracts\Service_Provider;

/**
 * Class Hooks.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__;
 */
class Hooks extends Service_Provider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function register() {
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__.hooks', $this );

		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds the actions required by the plugin.
	 *
	 * @since __TRIBE_VERSION__
	 */
	protected function add_actions() {
		add_action( 'tribe_load_text_domains', [ $this, 'load_text_domains' ] );
	}

	/**
	 * Adds the filters required by the plugin.
	 *
	 * @since __TRIBE_VERSION__
	 */
	protected function add_filters() {

	}

	/**
	 * Load text domain for localization of the plugin.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function load_text_domains() {
		$mopath = tribe( Plugin::class )->plugin_dir . 'lang/';
		$domain = '__TRIBE_DOMAIN__';

		// This will load `wp-content/languages/plugins` files first.
		Common::instance()->load_text_domain( $domain, $mopath );
	}
}
