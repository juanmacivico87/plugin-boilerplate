<?php
namespace PluginBoilerplate\Modules\Taxonomies;

/**
 * Taxonomy
 */
abstract class Taxonomy {
    protected string $singular = 'Taxonomy';
    protected string $plural = 'Taxonomies';
    protected bool $public = true;
    protected bool $publicly_queryable = true;
    protected bool $show_ui = true;
    protected bool $show_in_menu = true;
    protected bool $show_in_nav_menus = true;
    protected bool $show_in_rest = true;
    protected bool $hierarchical = true;
    protected string $rest_base   = '';
    protected string $query_var   = '';
    protected bool $show_in_quick_edit = true;
    protected bool $show_admin_column = true;
    protected string $description = '';
    protected bool $show_tagcloud = true;
    protected array $post_types   = [];
    protected array $rewrite = [ 
        'slug'          => '',
        'with_front'    => false,
        'ep_mask'       => EP_NONE,
    ];
    protected array $capabilities = [
        'manage_terms'  => 'manage_categories',
        'edit_terms'    => 'manage_categories',
        'delete_terms'  => 'manage_categories',
        'assign_terms'  => 'edit_posts',
    ];

    /**
     * __construct()
     *
     * @param   array      $args     Arguments to create the taxonomy.
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( array $args ) {
        $this->rewrite['hierarchical'] = $this->hierarchical;

        if ( false !== isset( $args['slug'] ) && false === empty( $args['slug'] ) ) {
            $this->rewrite['slug'] = $args['slug'];
        }

        $this->init();
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function init(): void {
        add_action( 'init', [ $this, 'add_custom_taxonomy' ] );
    }

    /**
     * get_labels()
     *
     * @return 	array
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function get_labels(): array {
        $common_labels = [
            'name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'singular_name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'menu_name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'all_items' => sprintf( __( 'All %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'edit_item' => sprintf( __( 'Edit %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'view_item' => sprintf( __( 'View %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'update_item' => sprintf( __( 'Update %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'add_new_item' => sprintf( __( 'Add new %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'new_item_name' => sprintf( __( 'New %s Name', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'search_items' => sprintf( __( 'Search %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'not_found' => sprintf( __( '%s not Found', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'back_to_items' => sprintf( __( 'Back to %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
        ];

        $hierarchical_labels = [
            'parent_item' => sprintf( __( 'Parent %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'parent_item_colon' => sprintf( __( 'Parent %s:', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
        ];

        $not_hierarchical_labels = [
            'popular_items' => sprintf( __( 'Popular %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'separate_items_with_commas' => sprintf( __( 'Separate %s with Commas', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'add_or_remove_items' => sprintf( __( 'Add or remove %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'choose_from_most_used' => sprintf( __( 'Choose from most used %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
        ];

        return false !== $this->hierarchical
            ? array_merge( $common_labels, $hierarchical_labels )
            : array_merge( $common_labels, $not_hierarchical_labels );
    }

    /**
     * add_custom_taxonomy()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_custom_taxonomy(): void {
        $args = [
            'label'  => $this->singular,
            'labels' => $this->get_labels(),
            'public' => $this->public,
            'publicly_queryable' => $this->publicly_queryable,
            'show_ui' => $this->show_ui,
            'show_in_menu' => $this->show_in_menu,
            'show_in_nav_menus' => $this->show_in_nav_menus,
            'show_in_rest' => $this->show_in_rest,
            'rest_base' => $this->rest_base,
            'show_in_quick_edit' => $this->show_in_quick_edit,
            'show_admin_column' => $this->show_admin_column,
            'description' => $this->description,
            'hierarchical' => $this->hierarchical,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite,
            'capabilities' => $this->capabilities,
        ];

        if ( false === $this->hierarchical ) {
            $args['show_tagcloud'] = $this->show_tagcloud;
        }

        register_taxonomy( $this::TAXONOMY_NAME, $this->post_types, $args );
    }
}
