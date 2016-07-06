<?php namespace BasePlugin;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DefaultServices implements ServiceProviderInterface {

	/**
	 * @var string The wp db option name that stores the plugins version number
	 */
	protected $plugin_option_name;

	/**
	 * @var string The main plugin file
	 */
	private $main_file;

	/**
	 * DefaultServices constructor.
	 *
	 * @param string $main_file The main plugin file 
	 */
	public function __construct( $main_file ) {
		$this->main_file = $main_file;
	}


	/**
	 * Registers services on the given container.
	 *
	 * This method should only be used to configure services and parameters.
	 * It should not get services.
	 *
	 * @param Container $pimple A container instance
	 */
	public function register( Container $pimple ) {

		$pimple['plugin_updated'] = function ( $c ) {
			if ( ! isset( $c['plugin_option_name'] ) ) {
				return;
			}

			$this->plugin_option_name = $c['plugin_option_name'];

			add_action( 'plugins_loaded', [ $this, 'checkForUpdate' ], 999 );
		};

	}

	public function checkForUpdate() {

		$data = get_plugin_data( $this->main_file );
		if ( $data['Version'] != get_option( $this->plugin_option_name ) ) {
			do_action( $this->plugin_option_name . '_updated', $data['Version'] );
			update_option($this->plugin_option_name, $data['Version']);
		}

	}

}
