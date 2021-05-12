<?php
/**
 * Handles the Extension plugin dependency manifest registration.
 *
 * @since __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 */

namespace Tribe\Extensions\__TRIBE_NAMESPACE__;

use Tribe__Abstract_Plugin_Register as Abstract_Plugin_Register;

/**
 * Class Plugin_Register.
 *
 * @since   __TRIBE_VERSION__
 *
 * @package Tribe\Extensions\__TRIBE_NAMESPACE__
 *
 * @see Tribe__Abstract_Plugin_Register For the plugin dependency manifest registration.
 */
class Plugin_Register extends Abstract_Plugin_Register {
	protected $base_dir     = Plugin::FILE;
	protected $version      = Plugin::VERSION;
	protected $main_class   = Plugin::class;
	protected $dependencies = [
		'parent-dependencies' => [
			'Tribe__Events__Main' => '5.1.0-dev',
		],
	];
}
