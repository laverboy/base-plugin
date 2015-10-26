<?php namespace BasePlugin;


use Pimple\Container;

class Plugin extends Container {

	public function run(){
		foreach( $this->keys() as $key ){ // Loop on contents
			$content = $this[$key];

			if( is_object( $content ) ){
				$reflection = new \ReflectionClass( $content );
				if( $reflection->hasMethod( 'init' ) ){
					$content->init(); // Call run method on object
				}
			}
		}
	}

}