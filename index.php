<a href="https://giles-deacon.com/">https://giles-deacon.com/</a>

<div>
  <?php
    if( have_posts() ) {
      while( have_posts() ) {
        the_post();
      
        $type = get_post_meta($post->ID, '_cmb_type', true);
        $year = get_post_meta($post->ID, '_cmb_year', true);
        $gallery = get_post_meta($post->ID, '_cmb_gallery');
  ?>
  <div>
    <h4>
      <?php 
        if (!empty($type)) {
          echo $type;
        } else {
          the_title();
        }
        
        if (!empty($year)) {
          echo ' ' . $year;
        }
      ?>
    </h4>
    <?php
      if (!empty($gallery[0])) {
        foreach ($gallery[0] as $key => $image) {
          echo wp_get_attachment_image($key);
        }
      }
    ?>
  </div>
<?php
      }
    }
?>
</div>