<?php
/**
 * Handles registering all Assets for the Plugin.
 *
 * To remove a Asset you can use the global assets handler:
 *
 * ```php
 *  tribe( 'assets' )->remove( 'asset-name' );
 * ```
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 */

namespace Tribe\Extensions\__TRIBE_NAMESPACE__;

/**
 * Register Assets.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 */
class Assets extends \tad_DI52_ServiceProvider {
	/**
	 * Binds and sets up implementations.
	 *
	 * @since __TRIBE_VERSION__
	 */
	public function register() {
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'extension.__TRIBE_SLUG_CLEAN__.assets', $this );

		$plugin = tribe( Plugin::class );

	}
}
