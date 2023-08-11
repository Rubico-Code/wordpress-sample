<?php
/**
 * Class ACF_Gutenberg
 */
class ACF_Gutenberg
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'loadFields']);
    }

    /**
     * @return void
     * Load the ACF block with the required template and assets files.
     */
    public static function init(): void
    {
        register_block_type(__DIR__ . '/blocks/testimonial');
    }

    /**
     * @return void
     * Show error if ACF pro version does not found when installing the plugin.
     */
    public static function pluginActivation(): void
    {
        if (!class_exists('acf_pro')) {
            die('ACF pro version does not found!');
        }
    }

    /**
     * @return void
     * Create a field group and load all the field for the testimonial.
     */
    public function loadFields(): void
    {
        if (function_exists('acf_add_local_field_group')):
            $array = [
                'key' => 'group_acf_testimonial_1',
                'title' => 'Testimonial Block Field Group 2',
                'fields' => [
                    [
                        'key' => 'field_acf_testimonial_1',
                        'label' => 'Testimonial',
                        'name' => 'testimonial',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'placeholder' => '',
                        'new_lines' => '',
                    ],
                    [
                        'key' => 'field_acf_testimonial_2',
                        'label' => 'Author',
                        'name' => 'author',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ],
                    [
                        'key' => 'field_acf_testimonial_3',
                        'label' => 'Role',
                        'name' => 'role',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ],
                    [
                        'key' => 'field_acf_testimonial_4',
                        'label' => 'Image',
                        'name' => 'image',
                        'aria-label' => '',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'id',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_acf_testimonial_5',
                        'label' => 'Color Settings',
                        'name' => 'color_setting',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'open' => 0,
                        'multi_expand' => 0,
                        'endpoint' => 0,
                    ],
                    [
                        'key' => 'field_acf_testimonial_6',
                        'label' => 'Background Color',
                        'name' => 'background_color',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => 0,
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                    ],
                    [
                        'key' => 'field_acf_testimonial_7',
                        'label' => 'Text Color',
                        'name' => 'text_color',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => 0,
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                    ]
                ],
                'location' => [
                    [[
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf-gutenberg-block/testimonial'
                    ]]
                ],
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
            ];
            acf_add_local_field_group($array);
        endif;
    }
}

new ACF_Gutenberg();