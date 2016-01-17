<?php namespace BasePlugin;

class Example {

	/** @var  string The base path for this plugin */
	protected $path;

	/** @var  Logger */
	protected $log;

	function __construct( $path ) {
		$this->path = $path;
		$this->pluginName = "BasePlugin";
	}

	/**
	 * Use the init method to add your wordpress hooks and actions,
	 * this method will be called automatically when this class is
	 * instantiated through the pimple DI.
	*/
	public function init() {
		add_action( 'admin_notices', [ $this, 'showWelcomeMessage' ] );
	}

	public function showWelcomeMessage() {
		echo sprintf(
			"<div class='updated'><p>The <strong>%s</strong> plugin has been installed at <em>%s</em></p></div>",
			$this->pluginName,
			$this->path
		);

		// pass logger to your class whenever you want to log something
		// ensure log directory has correct permissions
		BasePlugin\Log::Info('Welcome message shown', ['action' => 'admin_notices']);
	}

}
