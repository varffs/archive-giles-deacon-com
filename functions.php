<?php
get_template_part( 'library/metaboxes' );
get_template_part( 'library/taxonomies' );

function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'vendor/cmb2/cmb2/init.php';
  }
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );
  
function composer_autoload() {
  require_once( 'vendor/autoload.php' );
}
add_action( 'init', 'composer_autoload', 10 );
?>