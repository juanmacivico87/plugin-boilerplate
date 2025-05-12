<?php
namespace PluginBoilerplate\App;

use PluginBoilerplate\Services\HelpersService;

/**
 * App
 */
class App {
    private WpDependencies $wp_dependencies;

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct() {
        $this->load_dependencies();

        if ( false === $this->wp_dependencies->check_dependencies() ) {
            add_action( 'admin_notices', [ $this, 'render_dependencies_not_found_notice' ] );
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
    public function init(): void {
        add_action( 'plugins_loaded', [ $this, 'load_classes' ] );
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'load_public_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'load_admin_assets' ] );
    }

    /**
     * load_dependencies()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_dependencies(): void {
        $this->wp_dependencies = new WpDependencies();
    }

    /**
     * load_classes()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_classes(): void {
        $helpers = new HelpersService();
    }

    /**
     * load_textdomain()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_textdomain(): void {
        load_plugin_textdomain( PLUGIN_BOILERPLATE_TEXTDOMAIN, false, PLUGIN_BOILERPLATE_LANG_DIR );
    }

    /**
     * load_public_assets()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_public_assets(): void {
        wp_enqueue_script( 'plugin-boilerplate-front', PLUGIN_BOILERPLATE_PUBLIC_ASSETS . '/js/scripts.js', [], PLUGIN_BOILERPLATE_VERSION, true );
        wp_enqueue_style( 'plugin-boilerplate-front', PLUGIN_BOILERPLATE_PUBLIC_ASSETS . '/css/styles.css', [], PLUGIN_BOILERPLATE_VERSION );
    }

    /**
     * load_admin_assets()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_admin_assets(): void {
        wp_enqueue_script( 'plugin-boilerplate-admin', PLUGIN_BOILERPLATE_ADMIN_ASSETS . '/js/scripts.js', [], PLUGIN_BOILERPLATE_VERSION, true );
        wp_enqueue_style( 'plugin-boilerplate-admin', PLUGIN_BOILERPLATE_ADMIN_ASSETS . '/css/styles.css', [], PLUGIN_BOILERPLATE_VERSION );
    }

    /**
     * render_dependencies_not_found_notice()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function render_dependencies_not_found_notice(): void {
        $dependencies = WpDependencies::DEPENDENCIES;

        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php echo sprintf( __( 'In order to activate the <b>%s</b> plugin, you have to meet the next requirements:', PLUGIN_BOILERPLATE_TEXTDOMAIN ), PLUGIN_BOILERPLATE_NAME ); ?></p>
            <ul>
                <li><?php echo sprintf( __( 'PHP version: %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), WpDependencies::MIN_PHP_VERSION ); ?></li>
                <li><?php echo sprintf( __( 'WordPress version: %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), WpDependencies::MIN_WP_VERSION ); ?></li>
                <?php foreach( $dependencies as $name => $plugin ): ?>
                    <li><?php echo sprintf( __( 'Activate plugin: %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $name ); ?></li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php
    }
}
