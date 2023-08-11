<?php
$background_type = block_value( 'background-type' );
if ( $background_type !== 'full-width-media' ) {
	$bg_class = $background_type;
}
$title               = block_value( 'title' );
$description         = block_value( 'description' );
$rotate_interval_sec = '8000';
$rotate_interval     = block_value( 'rotate-interval' );
if ( $rotate_interval != '' ) {
	$rotate_interval_sec = $rotate_interval;
}
$text_color = block_value( 'text-color' );
?>

<div class="module_generic-slider body-l alignfull <?php echo $bg_class; ?>">
	<div class="section_wrapper bg-blocks">
		<?php
		if ( $background_type == 'full-width-media' ) {
			$background_media_ID = block_value( 'background-media' );
			$background_media    = wp_get_attachment_image_src( $background_media_ID, 'full' );
			if ( ! empty( $background_media ) ) {
				$filename              = basename( $background_media[0] );
				$background_media_type = wp_check_filetype_and_ext( $background_media[0], $filename );
				$allowed_image_types   = [ 'image/png', 'image/jpeg', 'image/svg+xml', 'image/gif' ];
				if ( in_array( $background_media_type['type'], $allowed_image_types ) ) { ?>
					<div class="bg-media object-fit"><img src="<?php echo $background_media[0]; ?>"
					                                      alt="<?php _e( 'Background Media', 'customGenericSlider' ); ?>"/>
					</div>
				<?php }
			} else {
				$video_upload_path = wp_get_attachment_url( $background_media_ID );
				$ext               = pathinfo( $video_upload_path );
				$validate          = wp_check_filetype_and_ext( $ext['dirname'], $ext['basename'] );
				$video_type        = $validate['type'];
				$video_url         = $video_upload_path;
				?>
				<div class="bg-media-video object-fit">
					<video playsinline="" webkit-playsinline="webkit-playsinline" autoplay muted loop id="myVideo">
						<source src="<?php echo $video_url; ?>" type="video/mp4">
						<?php _e( 'Your browser does not support HTML5 video.', 'customGenericSlider' ); ?>
					</video>
				</div>
			<?php }
		} ?>
	</div>

	<div class="grid-wrap">
		<div class="head_divided" data-aos="fade-down" data-aos-duration="1500">
			<?php if ( isset( $title ) && $title !== '' ): ?><h4
				class="<?php echo $text_color; ?>"><?php echo $title; ?></h4><?php endif; ?>
			<?php if ( isset( $description ) && $description !== '' ): ?>
				<div class="<?php echo $text_color; ?>"><?php echo $description; ?></div><?php endif; ?>
			<?php /* if (block_value('rotate_interval')) : ?>
                <h2><?php echo $rotate_interval; ?></h2>
            <?php endif; */ ?>
		</div>
		<div class="generic_slider">
			<?php if ( block_rows( 'add-slider' ) ) : ?>
				<div class="slider_generic">
					<?php while ( block_rows( 'add-slider' ) ): block_row( 'add-slider' );
						$slider_heading      = block_sub_field( 'heading', false );
						$slider_content      = block_sub_field( 'content', false );
						$slider_icon_ID      = block_sub_field( 'slider-icon', false );
						$slider_image_ID     = block_sub_field( 'slider-image', false );
						$slider_button       = block_sub_field( 'slider-button', false );
						$slider_link_for_cta = block_sub_field( 'slider-link-for-cta', false );
						?>

						<div class="slider-info" data-time="<?php echo $rotate_interval_sec; ?>">
							<div class="img-slider object-fit">
								<?php if ( isset( $slider_image_ID ) && $slider_image_ID != '' ):
									$slider_image = wp_get_attachment_image_src( $slider_image_ID, 'full' ); ?>
									<img src="<?php echo $slider_image[0]; ?>"
									     alt="<?php _e( 'Slider Image', 'customGenericSlider' ); ?>"/>
								<?php endif; ?>
							</div>
							<div class="txt-testimonial">
								<?php if ( isset( $slider_heading ) && $slider_heading !== '' ): ?>
									<div class="caps text-plum"><?php echo $slider_heading; ?></div><?php endif; ?>
								<?php if ( isset( $slider_content ) && $slider_content !== '' ): ?>
									<h5><?php echo $slider_content; ?></h5>
								<?php endif; ?>
								<?php if ( $slider_link_for_cta != '' && $slider_button != '' ) { ?>
									<a href="<?php echo get_the_permalink( $slider_link_for_cta->ID ); ?>"
									   class="btn-icon icon-animated">
										<span class="btn-txt"><?php echo $slider_button; ?></span>
										<span class="btn-rounded"><img
												src="<?php echo CUSTOM_GENESIS_PLUGIN_URL ?>/images/arrow-right-black.svg"
												alt="<?php _e( 'Right Arrow Black', 'customGenericSlider' ); ?>"></span>
									</a>
								<?php } ?>
							</div>
						</div>

					<?php endwhile; ?>
				</div>
			<?php endif;
			reset_block_rows( 'add-slider' );
			?>
		</div>
	</div>
</div>