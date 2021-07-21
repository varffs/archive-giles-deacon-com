<?php
/**
 *
 */
function giles_archive_complete() {
  $posts = get_posts();
 
  if ( empty( $posts ) ) {
    return null;
  }
  
  $data = [];
  
  foreach ($posts as $index => $post) {    
    $gallery_raw = get_post_meta($post->ID, '_cmb_gallery');
    $type = get_post_meta($post->ID, '_cmb_type');
    $year = get_post_meta($post->ID, '_cmb_year');
    
    if (empty($year)) {
      return;
    }
    
    $gallery = [];
    
    foreach ($gallery_raw[0] as $id => $image) {  
      $attachment = get_post($id);
          
      $gallery[] = (object) [
        'html' => wp_get_attachment_image($id, array(1000, 1000)),
        'caption' => !empty($attachment->post_excerpt) ? $attachment->post_excerpt : $attachment->post_title
      ];
    }
    
    $data[intval($year[0])][] = (object) [
      'title' => $post->post_title,
      'type' => count($type) > 0 ? $type[0] : null,
      'gallery' => $gallery,
    ];
  }
 
  return $data;
}
  
add_action( 'rest_api_init', function () {
  register_rest_route( 'giles/v1', '/data', array(
    'methods' => 'GET',
    'callback' => 'giles_archive_complete',
  ) );
} );