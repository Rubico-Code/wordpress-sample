<?php
//https://make.wordpress.org/core/2022/05/03/page-creation-patterns-in-wordpress-6-0/
register_block_pattern(
'gutenpride/paragraph',
array(
'title'      => __( 'GutenPride Paragraph', 'gutenpride' ), //required
'description' => __('This is custom pattern for GutenPride','gutenpride'),
'categories' => array('gutenpride'),
'keywords' => array('paragraph','nick','gutenpride','pattern','patterns'),
'viewportWidth' => 800,
'blockTypes' => array( 'core/post-content' ),
'content'    => '<!-- wp:create-block/gutenpride {"showPostCounts":true,"selectedCategory":5,"displayAuthor":true,"displayFutureImg":true} /-->', //required
)
);


