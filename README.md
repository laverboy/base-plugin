# Base Plugin
The beginnings of a Wordpress plugin. Please delete this README (after you have read it) and replace with the details of your plugin.

# Dependency Container
This base plugin uses the [Pimple](http://pimple.sensiolabs.org/) dependency container. It's very simple and very powerful. Check it out.

To add a new service simply register a closure function against the `$plugin` variable. 

    $plugin['example'] = function ( $c ) {
    	return new BasePlugin\Example( $c['service_or_variable_available_in_the_container'] );
    };

If the registered class has a method called init, that method will be called after instantiation. This is where you would add your Wordpress hooks and filters.

    public function init() {
        add_action( 'init', [ $this, 'doSomethingAwesome' ] );
    }
    
# Logging
The plugin includes the monolog logging package. To use call the static class with the matching log severity level method:

    BasePlugin\Log::info("New user added.", ['extra_information' => 'the something that was done']);
    BasePlugin\Log::emergency("It's all on fire, get out!", ['fire_started' => '10:00:00', 'death_toll' => 'unknown']);

See [Monolog](https://github.com/Seldaek/monolog) for more information.