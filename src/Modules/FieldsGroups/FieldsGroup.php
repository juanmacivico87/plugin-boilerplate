<?php
namespace PluginBoilerplate\Modules\FieldsGroups;

/**
 * FieldsGroup
 */
abstract class FieldsGroup {
    protected string $title = '';
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
    public function __construct() {
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
        add_action( 'init', [ $this, 'create_fields_group' ] );
    }

    /**
     * get_fields()
     *
     * @return 	array
     * @access 	protected
     * @package	plugin-boilerplate
     */
    protected function get_fields(): array {
        // Set into $fields array the fields from ACF plugin.
        $fields = [];

        return $fields;
    }

    /**
     * get_location()
     *
     * @return 	array
     * @access 	protected
     * @package	plugin-boilerplate
     */
    protected function get_location(): array {
        // Copy into $location array the array of locations for the group of fields.
        $location = [];

        return $location;
    }

    /**
     * create_fields_group()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_fields_group(): void {
        acf_add_local_field_group( [
            'key' => 'group_' . md5( $this::GROUP_NAME ),
            'title' => $this->title,
            'fields' => $this->get_fields(),
            'location' => $this->get_location(),
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
