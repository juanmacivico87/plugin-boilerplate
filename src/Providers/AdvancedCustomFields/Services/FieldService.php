<?php
namespace PluginBoilerplate\Providers\AdvancedCustomFields\Services;

/**
 * FieldService
 */
class FieldService
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
     * create_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function create_field( array $args = [] ): array
    {
        if ( false !== empty( $args ) ) {
            return [];
        }

        $name = false !== isset( $args['name'] ) && false === empty( $args['name'] ) ? $args['name'] : null;

        if ( null === $name ) {
            return [];
        }

        return [
            'key' => 'field_' . md5( $name ),
            'name' => $name,
            'label' => false !== isset( $args['label'] ) && false === empty( $args['label'] ) ? $args['label'] : '',
            'instructions' => false !== isset( $args['instructions'] ) && false === empty( $args['instructions'] ) ? $args['instructions'] : '',
            'required' => false !== isset( $args['required'] ) && false === empty( $args['required'] ) ? $args['required'] : false,
            'conditional_logic' => false !== isset( $args['conditional_logic'] ) && false === empty( $args['conditional_logic'] ) && false !== is_array( $args['conditional_logic'] ) ? $args['conditional_logic'] : 0,
            'wrapper' => [
                'width' => false !== isset( $args['width'] ) && false === empty( $args['width'] ) ? $args['width'] : '',
                'class' => false !== isset( $args['class'] ) && false === empty( $args['class'] ) ? $args['class'] : '',
                'id' => false !== isset( $args['id'] ) && false === empty( $args['id'] ) ? $args['id'] : '',
            ],
        ];
    }

    /**
     * create_text_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_text_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'text';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['prepend'] = false !== isset( $args['prepend'] ) && false === empty( $args['prepend'] ) ? $args['prepend'] : '';
        $field['append'] = false !== isset( $args['append'] ) && false === empty( $args['append'] ) ? $args['append'] : '';
        $field['maxlength'] = false !== isset( $args['maxlength'] ) && false === empty( $args['maxlength'] ) ? $args['maxlength'] : '';

        return $field;
    }

    /**
     * create_textarea_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_textarea_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'textarea';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['maxlength'] = false !== isset( $args['maxlength'] ) && false === empty( $args['maxlength'] ) ? $args['maxlength'] : '';
        $field['rows'] = false !== isset( $args['rows'] ) && false === empty( $args['rows'] ) ? $args['rows'] : '';
        $field['new_lines'] = false !== isset( $args['new_lines'] ) && false === empty( $args['new_lines'] ) ? $args['new_lines'] : '';

        return $field;
    }

    /**
     * create_number_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_number_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'number';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['prepend'] = false !== isset( $args['prepend'] ) && false === empty( $args['prepend'] ) ? $args['prepend'] : '';
        $field['append'] = false !== isset( $args['append'] ) && false === empty( $args['append'] ) ? $args['append'] : '';
        $field['min'] = false !== isset( $args['min'] ) && false === empty( $args['min'] ) ? $args['min'] : '';
        $field['max'] = false !== isset( $args['max'] ) && false === empty( $args['max'] ) ? $args['max'] : '';
        $field['step'] = false !== isset( $args['step'] ) && false === empty( $args['step'] ) ? $args['step'] : '';

        return $field;
    }

    /**
     * create_range_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_range_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'range';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['prepend'] = false !== isset( $args['prepend'] ) && false === empty( $args['prepend'] ) ? $args['prepend'] : '';
        $field['append'] = false !== isset( $args['append'] ) && false === empty( $args['append'] ) ? $args['append'] : '';
        $field['min'] = false !== isset( $args['min'] ) && false === empty( $args['min'] ) ? $args['min'] : '';
        $field['max'] = false !== isset( $args['max'] ) && false === empty( $args['max'] ) ? $args['max'] : '';
        $field['step'] = false !== isset( $args['step'] ) && false === empty( $args['step'] ) ? $args['step'] : '';

        return $field;
    }

    /**
     * create_email_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_email_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'email';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['prepend'] = false !== isset( $args['prepend'] ) && false === empty( $args['prepend'] ) ? $args['prepend'] : '';
        $field['append'] = false !== isset( $args['append'] ) && false === empty( $args['append'] ) ? $args['append'] : '';

        return $field;
    }

    /**
     * create_url_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_url_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'url';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';

        return $field;
    }

    /**
     * create_password_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_password_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'password';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['prepend'] = false !== isset( $args['prepend'] ) && false === empty( $args['prepend'] ) ? $args['prepend'] : '';
        $field['append'] = false !== isset( $args['append'] ) && false === empty( $args['append'] ) ? $args['append'] : '';

        return $field;
    }

    /**
     * create_select_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_select_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'select';
        $field['default_value'] = false !== isset( $args['default_value'] ) && false === empty( $args['default_value'] ) ? $args['default_value'] : '';
        $field['placeholder'] = false !== isset( $args['placeholder'] ) && false === empty( $args['placeholder'] ) ? $args['placeholder'] : '';
        $field['choices'] = false !== isset( $args['choices'] ) && false === empty( $args['choices'] ) ? $args['choices'] : [];
        $field['allow_null'] = false !== isset( $args['allow_null'] ) && false === empty( $args['allow_null'] ) ? (int)$args['allow_null'] : 0;
        $field['multiple'] = false !== isset( $args['multiple'] ) && false === empty( $args['multiple'] ) ? (int)$args['multiple'] : 0;
        $field['ui'] = false !== isset( $args['ui'] ) && false === empty( $args['ui'] ) ? (int)$args['ui'] : 1;
        $field['ajax'] = false !== isset( $args['ajax'] ) && false === empty( $args['ajax'] ) ? (int)$args['ajax'] : 0;
        $field['return_format'] = false !== isset( $args['return_format'] ) && false === empty( $args['return_format'] ) ? $args['return_format'] : 'value';

        return $field;
    }

    /**
     * create_link_field()
     *
     * @param   array $args Arguments to create the field.
     * @return 	array
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_link_field( array $args = [] ): array
    {
        $field = $this->create_field( $args );

        if ( false !== empty( $field ) ) {
            return [];
        }

        $field['type'] = 'link';
        $field['return_format'] = false !== isset( $args['return_format'] ) && false === empty( $args['return_format'] ) ? $args['return_format'] : 'array';

        return $field;
    }
}
