<?php namespace BasePlugin;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DefaultServicesProvider implements ServiceProviderInterface {

	/**
	 * Registers services on the given container.
	 *
	 * This method should only be used to configure services and parameters.
	 * It should not get services.
	 *
	 * @param Container $pimple A container instance
	 */
	public function register( Container $pimple ) {

		// Logger
		$pimple['log'] = function ( $c ) {
			$log = new Logger( 'Plugin' );

			return $log->pushHandler(
				new RotatingFileHandler( $c['path'] . 'log/main.log', 5 )
			);
		};
	}
}