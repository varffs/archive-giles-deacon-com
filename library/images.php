<?php 
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'x50', 50, 9999, false );
  add_image_size( 'x200', 200, 9999, false );
  add_image_size( 'x400', 400, 9999, false );
  add_image_size( 'x500', 500, 9999, false );
  add_image_size( 'x800', 800, 9999, false );
  add_image_size( 'x1000', 1000, 9999, false );
  add_image_size( 'x1400', 1400, 9999, false );
  add_image_size( 'x1800', 1800, 9999, false );
}

// Custom img attributes to be compatible with lazysize
function add_lazysize_on_srcset($attr, $attachment) {
  if (!is_admin()) {
    // if image has data-no-lazysizes attribute dont add lazysizes classes
    if (isset($attr['data-no-lazysizes'])) {
      unset($attr['data-no-lazysizes']);
      return $attr;
    }

    // Add lazysize class
    $attr['class'] .= ' lazyload';

    if (isset($attr['srcset'])) {
      // Add lazysize data-srcset
      $attr['data-srcset'] = $attr['srcset'];
      // Remove default srcset
      unset($attr['srcset']);
    } else {
      // Add lazysize data-src
      $attr['data-src'] = $attr['src'];
    }

    // Set default to white blank
    // $attr['src'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAABCAQAAABTNcdGAAAAC0lEQVR42mNkgAIAABIAAmXG3J8AAAAASUVORK5CYII=';
    
    $low_res = wp_get_attachment_image_src($attachment->ID, 'x50'); // set default src to low res for blur up effect
    
    $attr['src'] = $low_res[0];
  }

  return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_lazysize_on_srcset', 10, 2);