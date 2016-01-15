<?php namespace BasePlugin;


use Pimple\Container;

class Plugin extends Container {

	public function run(){
		foreach( $this->keys() as $key ){ // Loop on contents
			$content = $this[$key];

			if ( is_object( $content ) && method_exists( $content, 'init' ) ) {
				$content->init( $this ); // Call run method on object
			}
		}
	}

}
