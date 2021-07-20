<a href="https://giles-deacon.com/">https://giles-deacon.com/</a>

<div>
  <?php
    if( have_posts() ) {
      while( have_posts() ) {
        the_post();
        
        $years = get_the_terms($post, 'year');
        
        $year = false;
        
        if (count($years) > 0) {
          $year = $years[0];
        }        
        $type = get_post_meta($post->ID, '_cmb_type');
        $gallery = get_post_meta($post->ID, '_cmb_gallery');
  ?>
  <div>
    <h4>
      <?php 
        if (!empty($type[0])) {
          echo $type[0];
        } else {
          the_title();
        }
        
        if ($year) {
          echo ' ' . $year->name;
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