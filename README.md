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

# Updater action
As Wordpress doesn't have a default way to handle when a plugin is updated this base plugin includes its own work around.

One of the default services listens for changes in the plugin version number stored against the `$plugin['plugin_option_name']` and triggers an action with the title of `$plugin['plugin_option_name']` followed by `_updated`.

eg. when 'BasePlugin_details' is updated the action 'BasePlugin_details_updated' will be called.

Furthermore the action is passed the new version number.

# Testing
The initial setup for testing your plugin is included in the base plugin.

Simply add your tests in the Tests directory and run `phpunit` in the root directory.