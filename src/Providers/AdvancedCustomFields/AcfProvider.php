<?php
namespace PluginBoilerplate\Providers\AdvancedCustomFields;

/**
 * AcfProvider
 */
class AcfProvider
{
    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct()
    {
    }

    /**
     * add_options_page()
     *
     * @param   array $args Arguments for the options page.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_options_page( array $args ): array
    {
        return acf_add_options_page( $args );
    }

    /**
     * add_local_field_group()
     *
     * @param   array $fields_group Arguments for the fields group.
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_local_field_group( array $fields_group ): void
    {
        acf_add_local_field_group( $fields_group );
    }
}
