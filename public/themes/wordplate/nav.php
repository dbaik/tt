<header>
  <nav class="navbar fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler__bar navbar-toggler__bar--top"></span>
      <span class="navbar-toggler__bar navbar-toggler__bar--middle"></span>
      <span class="navbar-toggler__bar navbar-toggler__bar--bottom"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <?php wp_nav_menu([
        'theme_location' => 'navigation',
        'container_class' => '',
        'menu_class' => 'navbar-nav mr-auto d-flex justify-content-end', 
        ]); 
      ?>
      

      <?php
      $slides = array(); 
      $args = array( 'post_type' => 'featured', 'posts_per_page' => 0 );
      $slider_query = new WP_Query( $args );
      if ( $slider_query->have_posts() ) {
          while ( $slider_query->have_posts() ) {
              $slider_query->the_post();
              if(has_post_thumbnail()){
                  $temp = array();
                  $thumb_id = get_post_thumbnail_id();
                  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                  $thumb_url = $thumb_url_array[0];
                  $temp['title'] = get_the_title();
                  $temp['excerpt'] = get_the_excerpt();
                  $temp['image'] = $thumb_url;
                  $temp['link'] = get_permalink(get_the_ID());
                  $slides[] = $temp;
              }
          }
      } 
      wp_reset_postdata();
      ?>

      <?php if(count($slides) > 0) { ?>

      <div id="carouselIndicators" class="carousel carousel-custom slide d-none d-md-block">
          <ol class="carousel-indicators">
              <?php for($i=0;$i<count($slides);$i++) { ?>
              <li data-target="#carouselIndicators" data-slide-to="<?php echo $i ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
              <?php } ?>
          </ol>

          <div class="carousel-inner" role="listbox">
              <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
              <div class="carousel-item <?php if($i == 0) { ?>active<?php } ?>">
                  <img src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>">
                  <div class="carousel-caption">
                    <h3 class="text-uppercase"><?php echo $title; ?></h3>
                    <p><?php echo $excerpt; ?></p>
                    <a href="<?php echo $link ?>">
                      Read More Here
                    </a>
                  </div>
              </div>
              <?php $i++; } ?>
          </div>

      </div>
      <?php } ?>
      
    </div>
  </nav>
</header>