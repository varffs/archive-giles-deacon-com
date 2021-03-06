<?php
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );

function igv_cmb_metaboxes() {
  $prefix = '_cmb_';

  $years_options = [];
  
  for ($i = 2003; $i <= date('Y'); $i++) {
    $years_options[$i] = $i;
  }

  $meta_boxes = new_cmb2_box( array (
    'id'         => 'post_metabox',
    'title'      => __( 'Collection Meta', 'cmb' ),
    'object_types'      => array( 'post' ), // Post type
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true, // Show field names on the left
    'show_in_rest' => WP_REST_Server::READABLE,
  ) );

  $meta_boxes->add_field( array(
    'name'             => 'Year',
  	'desc'             => 'Select a year. If none is selected the this will show in the top section',
  	'id'               => $prefix . 'year',
  	'type'             => 'select',
  	'show_option_none' => true,
  	'default'          => 'custom',
  	'options'          => $years_options
  ) );
  
  $meta_boxes->add_field( array(
    'name'             => 'Collection Type',
  	'desc'             => 'Select a type. If none is selected the type will show from the name of the post',
  	'id'               => $prefix . 'type',
  	'type'             => 'select',
  	'show_option_none' => true,
  	'default'          => 'custom',
  	'options'          => array(
  		'Spring / Summer' => __( 'Spring / Summer', 'cmb2' ),
  		'Autumn / Winter'   => __( 'Autumn / Winter', 'cmb2' ),
  		'Resort'     => __( 'Resort', 'cmb2' ),
  		'Pre-Fall'     => __( 'Pre-Fall', 'cmb2' ),
    ),
  ) );

  $meta_boxes->add_field( array(
    'name'             => 'Collection Gallery',
  	'desc'             => 'Add all the images in the gallery in order here. Their description in the media editor will be the caption on the site',
  	'id'               => $prefix . 'gallery',
  	'type'             => 'file_list',
    'preview_size' => array( 200, 300 ),
  	'query_args' => array( 'type' => 'image' ),
  ) );
}
?>