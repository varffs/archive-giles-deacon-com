<?php
/**
 *
 */
function giles_archive_complete() {
  $posts = get_posts(array('posts_per_page' => -1));
 
  if (empty($posts)) {
    return null;
  }
  
  $data = [];
  
  foreach ($posts as $index => $post) {    
    $gallery_raw = get_post_meta($post->ID, '_cmb_gallery');
    $type = get_post_meta($post->ID, '_cmb_type', true);
    $year = get_post_meta($post->ID, '_cmb_year', true);

    $data_index = empty($year) ? 9999 : intval($year);
        
    $gallery = [];
    
    foreach ($gallery_raw[0] as $id => $image) {  
      $attachment = get_post($id);
          
      $gallery[] = (object) [
        'html' => wp_get_attachment_image($id, 'x500', false, array('loading' => false)),
        'caption' => !empty($attachment->post_excerpt) ? $attachment->post_excerpt : $attachment->post_title
      ];
    }
    
    $data[$data_index][] = (object) [
      'title' => $post->post_title,
      'type' => !empty($type) ? $type : null,
      'gallery' => $gallery,
    ];
  }
 
  return $data;
}
  
add_action('rest_api_init', function() {
  register_rest_route('giles/v1', '/data', array(
    'methods' => 'GET',
    'callback' => 'giles_archive_complete',
  ));
});