<?php
namespace PluginBoilerplate\Providers\AdvancedCustomFields\Resources;

use PluginBoilerplate\Providers\AdvancedCustomFields\AcfActions;
use PluginBoilerplate\Providers\AdvancedCustomFields\AcfProvider;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * SettingsPage
 *
 * @package	plugin-boilerplate
 */
abstract class SettingsPage
{
    private WpProvider $provider;
    private AcfProvider $acf;

    protected string $page_title = '';
    protected string $menu_title = '';
    protected string $capability = 'manage_options';
    protected string $position = '2.9';
    protected string $icon_url = 'dashicons-paperclip';
    protected bool $redirect = true;
    protected string $update_button = '';
    protected string $updated_message = '';

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( WpProvider $provider, AcfProvider $acf )
    {
        $this->provider = $provider;
        $this->acf = $acf;

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
        $this->set_default_labels();
        $this->provider->add_action( AcfActions::INIT, [ $this, 'create_settings_page' ] );
    }

    /**
     * set_default_labels()
     *
     * @return 	void
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function set_default_labels(): void
    {
        if ( false !== empty( $this->page_title ) ) {
            $this->page_title = $this->provider->translate( 'Settings' );
        }

        if ( false !== empty( $this->menu_title ) ) {
            $this->menu_title = $this->provider->translate( 'Settings' );
        }

        if ( false !== empty( $this->update_button ) ) {
            $this->update_button = $this->provider->translate( 'Save' );
        }

        if ( false !== empty( $this->updated_message ) ) {
            $this->updated_message = $this->provider->translate( 'Settings have been saved successfully' );
        }
    }

    /**
     * create_settings_page()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_settings_page(): void
    {
        $this->acf->add_options_page(
            [
                'page_title' => $this->page_title,
                'menu_title' => $this->menu_title,
                'menu_slug' => $this::MENU_SLUG,
                'capability' => $this->capability,
                'position' => $this->position,
                'icon_url' => $this->icon_url,
                'redirect' => $this->redirect,
                'update_button' => $this->update_button,
                'updated_message' => $this->updated_message,
            ]
        );
    }
}
