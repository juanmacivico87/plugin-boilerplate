<?php
namespace PluginBoilerplate\Providers\AdvancedCustomFields\Resources;

use PluginBoilerplate\Providers\AdvancedCustomFields\AcfProvider;
use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * FieldsGroup
 *
 * @package	plugin-boilerplate
 */
abstract class FieldsGroup
{
    private WpProvider $provider;
    private AcfProvider $acf;

    protected string $title = '';
    protected array $fields = [];
    protected array $location = [];
    protected int $menu_order = 0;
    protected string $position = 'normal';
    protected string $style = 'default';
    protected string $label_placement = 'top';
    protected string $instruction_placement = 'field';
    protected string $hide_on_screen = '';
    protected bool $active = true;
    protected string $description = '';
    protected int $show_in_rest = 0;

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
        $this->provider->add_action( WpActions::INIT, [ $this, 'create_fields_group' ] );
    }

    /**
     * create_fields_group()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_fields_group(): void
    {
        $this->acf->add_local_field_group( [
            'key' => 'group_' . md5( $this::GROUP_NAME ),
            'title' => $this->title,
            'fields' => $this->fields,
            'location' => $this->location,
            'menu_order' => $this->menu_order,
            'position' => $this->position,
            'style' => $this->style,
            'label_placement' => $this->label_placement,
            'instruction_placement' => $this->instruction_placement,
            'hide_on_screen' => $this->hide_on_screen,
            'active' => $this->active,
            'description' => $this->description,
            'show_in_rest' => $this->show_in_rest,
        ] );
    }
}