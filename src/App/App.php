<?php
namespace PluginBoilerplate\App;

use PluginBoilerplate\Providers\AdvancedCustomFields\AcfProvider;
use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpDependencies;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * App
 *
 * @package	plugin-boilerplate
 */
class App
{
    private AcfProvider $acf;
    private WpProvider $provider;
    private WpDependencies $wp_dependencies;

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct()
    {
        $this->load_dependencies();

        if ( false === $this->wp_dependencies->check_dependencies() ) {
            $this->provider->add_action( WpActions::ADMIN_NOTICES, [ $this, 'render_dependencies_not_found_notice' ] );
            return;
        }
        
        $this->init();
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function init(): void
    {
        $this->provider->add_action( WpActions::PLUGINS_LOADED, [ $this, 'load_classes' ] );
        $this->provider->add_action( WpActions::PLUGINS_LOADED, [ $this, 'load_textdomain' ] );
        $this->provider->add_action( WpActions::WP_ENQUEUE_SCRIPTS, [ $this, 'load_public_assets' ] );
        $this->provider->add_action( WpActions::ADMIN_ENQUEUE_SCRIPTS, [ $this, 'load_admin_assets' ] );
    }

    /**
     * load_dependencies()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_dependencies(): void
    {
        $this->provider = new WpProvider();
        $this->acf = new AcfProvider();
        $this->wp_dependencies = new WpDependencies( $this->provider );
    }

    /**
     * load_classes()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_classes(): void
    {
    }

    /**
     * load_textdomain()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_textdomain(): void
    {
        $this->provider->load_plugin_textdomain();
    }

    /**
     * load_public_assets()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_public_assets(): void
    {
        $this->provider->enqueue_script( 'plugin-boilerplate-front', PLUGIN_BOILERPLATE_PUBLIC_ASSETS . '/js/scripts.js', [], PLUGIN_BOILERPLATE_VERSION, true );
        $this->provider->enqueue_style( 'plugin-boilerplate-front', PLUGIN_BOILERPLATE_PUBLIC_ASSETS . '/css/styles.css', [], PLUGIN_BOILERPLATE_VERSION );
    }

    /**
     * load_admin_assets()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_admin_assets(): void
    {
        $this->provider->enqueue_script( 'plugin-boilerplate-admin', PLUGIN_BOILERPLATE_ADMIN_ASSETS . '/js/scripts.js', [], PLUGIN_BOILERPLATE_VERSION, true );
        $this->provider->enqueue_style( 'plugin-boilerplate-admin', PLUGIN_BOILERPLATE_ADMIN_ASSETS . '/css/styles.css', [], PLUGIN_BOILERPLATE_VERSION );
    }

    /**
     * render_dependencies_not_found_notice()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function render_dependencies_not_found_notice(): void
    {
        $dependencies = WpDependencies::DEPENDENCIES;

        ?><div class="notice notice-error is-dismissible">
            <p><?php echo $this->provider->translate( 'In order to activate the <b>' . PLUGIN_BOILERPLATE_NAME . '</b> plugin, you have to meet the next requirements:' ); ?></p>
            <ul>
                <li><?php echo sprintf( $this->provider->translate( 'PHP version: %s' ), WpDependencies::MIN_PHP_VERSION ) ?></li>
                <li><?php echo sprintf( $this->provider->translate( 'WordPress version: %s' ), WpDependencies::MIN_WP_VERSION ) ?></li>
                <?php foreach( $dependencies as $name => $plugin ) : ?>
                    <li><?php echo sprintf( $this->provider->translate( 'Activate plugin: %s' ), $name ) ?></li>
                <?php endforeach ?>
            </ul>
        </div><?php
    }
}
