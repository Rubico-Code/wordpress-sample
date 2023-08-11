<?php
// Needed for adding the PHP Template Method blocks from within the plugin
use function Genesis\CustomBlocks\add_block;

add_block(
	'custom-genesis-generic-slider',
	array(
		'title'        => 'Generic Slider',
		'category'     => 'common',
		'icon'         => 'account_circle',
		'keywords'     => array( 'text', 'post', 'image' ),
		'displayModal' => false,
		'fields'       => array(
			'background-type' =>
				array(
					'location' => 'editor',
					'width'    => '25',
					'help'     => '',
					'options'  =>
						array(
							0 =>
								array(
									'value' => '',
									'label' => __( 'Select Background Type', 'customGenericSlider' ),
								),
							1 =>
								array(
									'value' => 'full-width-media',
									'label' => __( 'Full Width Media', 'customGenericSlider' ),
								),
							2 =>
								array(
									'value' => 'on-dark-bkg',
									'label' => __( 'Black Theme', 'customGenericSlider' ),
								),
							3 =>
								array(
									'value' => 'on-light-bkg',
									'label' => __( 'White Theme', 'customGenericSlider' ),
								),
							4 =>
								array(
									'value' => 'on-transparent-bkg',
									'label' => __( 'Transparent', 'customGenericSlider' ),
								),
							5 =>
								array(
									'value' => 'bg-gradient-bronze',
									'label' => __( 'Bronze Gradient', 'customGenericSlider' ),
								),
							6 =>
								array(
									'value' => 'bg-gradient-silver',
									'label' => __( 'Silver Gradient', 'customGenericSlider' ),
								),
							7 =>
								array(
									'value' => 'bg-gradient-black-1',
									'label' => __( 'Gradient Black 1', 'customGenericSlider' ),
								),
							8 =>
								array(
									'value' => 'bg-gradient-black-2',
									'label' => __( 'Gradient Black 2', 'customGenericSlider' ),
								),

						),
					'default'  => 'on-light-bkg',
					'name'     => 'background-type',
					'label'    => __( 'Select Background Type', 'customGenericSlider' ),
					'order'    => 0,
					'control'  => 'select',
					'type'     => 'string',
				),

			'background-media' =>
				array(
					'location' => 'editor',
					'width'    => '50',
					'help'     => __( 'Upload if selected background type is Full Width Media (allowed file types: .png, .jpeg, .svg, .gif, .mp4)', 'customGenericSlider' ),
					'name'     => 'background-media',
					'label'    => __( 'Background Media', 'customGenericSlider' ),
					'order'    => 1,
					'control'  => 'file',
					'type'     => 'integer',
				),
			'title'            =>
				array(
					'location'    => 'editor',
					'width'       => '100',
					'help'        => '',
					'default'     => '',
					'placeholder' => '',
					'maxlength'   => '',
					'name'        => 'title',
					'label'       => __( 'Title', 'customGenericSlider' ),
					'control'     => 'text',
					'type'        => 'string',
					'order'       => 2,
				),
			'description'      =>
				array(
					'location'    => 'editor',
					'width'       => '100',
					'help'        => '',
					'default'     => '',
					'placeholder' => '',
					'maxlength'   => '',
					'number_rows' => 4,
					'new_lines'   => 'autop',
					'name'        => 'description',
					'label'       => __( 'Description', 'customGenericSlider' ),
					'order'       => 3,
					'control'     => 'textarea',
					'type'        => 'string',
				),
			'text-color'       =>
				array(
					'location' => 'editor',
					'width'    => '50',
					'help'     => '',
					'options'  =>
						array(
							0 =>
								array(
									'value' => '',
									'label' => __( 'Select Text Color', 'customGenericSlider' ),
								),
							1 =>
								array(
									'value' => 'text-black',
									'label' => __( 'Black', 'customGenericSlider' ),
								),
							2 =>
								array(
									'value' => 'text-white',
									'label' => __( 'White', 'customGenericSlider' ),
								),
							3 =>
								array(
									'value' => 'text-megenta-gradient',
									'label' => __( 'Magenta Gradient', 'customGenericSlider' ),
								),
							4 =>
								array(
									'value' => 'text-megenta',
									'label' => __( 'Magenta', 'customGenericSlider' ),
								),
							5 =>
								array(
									'value' => 'text-plum',
									'label' => __( 'Plum', 'customGenericSlider' ),
								),

						),
					'default'  => '',
					'name'     => 'text-color',
					'label'    => __( 'Select Text Color', 'customGenericSlider' ),
					'order'    => 4,
					'control'  => 'select',
					'type'     => 'string',
				),
			'rotate-interval'  =>
				array(
					'location'    => 'editor',
					'width'       => '50',
					'help'        => __( 'Number of seconds before the slide progresses to the next slide. Please enter the value in milliseconds. Eg. (1 second = 1000 ms )', 'customGenericSlider' ),
					'default'     => '',
					'placeholder' => '',
					'maxlength'   => '',
					'name'        => 'rotate-interval',
					'label'       => __( 'Rotate Interval', 'customGenericSlider' ),
					'control'     => 'text',
					'type'        => 'string',
					'order'       => 5,
				),
			'add-slider'       =>
				array(
					'help'       => '',
					'sub_fields' =>
						array(
							'heading'             =>
								array(
									'location'    => 'editor',
									'width'       => '50',
									'help'        => '',
									'default'     => '',
									'placeholder' => '',
									'maxlength'   => '',
									'name'        => 'heading',
									'label'       => __( 'Heading', 'customGenericSlider' ),
									'control'     => 'text',
									'type'        => 'string',
									'order'       => 0,
									'parent'      => 'add-slider',
								),
							'content'             =>
								array(
									'location' => 'editor',
									'width'    => '50',
									'help'     => '',
									'name'     => 'content',
									'label'    => __( 'Content', 'customGenericSlider' ),
									'order'    => 1,
									'control'  => 'text',
									'type'     => 'string',
									'parent'   => 'add-slider',
								),
							'slider-button'       =>
								array(
									'location'    => 'editor',
									'width'       => '25',
									'help'        => '',
									'default'     => '',
									'placeholder' => '',
									'maxlength'   => '',
									'name'        => 'slider-button',
									'label'       => __( 'Slider Button', 'customGenericSlider' ),
									'control'     => 'text',
									'type'        => 'string',
									'order'       => 2,
									'parent'      => 'add-slider',
								),
							'slider-link-for-cta' =>
								array(
									'location'            => 'editor',
									'width'               => '25',
									'help'                => '',
									'post_type_rest_slug' => 'posts',
									'name'                => 'slider-link-for-cta',
									'label'               => 'Slider Link For CTA',
									'order'               => 3,
									'control'             => 'post',
									'type'                => 'object',
									'parent'              => 'add-slider',
								),
							'slider-image'        =>
								array(
									'location'    => 'editor',
									'width'       => '50',
									'help'        => '',
									'default'     => '',
									'placeholder' => '',
									'maxlength'   => '',
									'name'        => 'slider-image',
									'label'       => __( 'Slider Image', 'customGenericSlider' ),
									'control'     => 'image',
									'type'        => 'integer',
									'order'       => 4,
									'parent'      => 'add-slider',
								),
						),
					'name'       => 'add-slider',
					'label'      => __( 'Add Slider (Required)', 'customGenericSlider' ),
					'location'   => 'editor',
					'order'      => 6,
					'control'    => 'repeater',
					'type'       => 'object',
				),
		),
	)
);

