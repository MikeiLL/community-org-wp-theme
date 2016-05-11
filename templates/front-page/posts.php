<?php

    $posts = get_posts(array(
      'posts_per_page'	=> 5,
      'post_type'			=> 'post',
      'orderby'				=> 'title',
      'order' 				=> 'ASC'
    ));

    if( $posts ): ?>


      <?php foreach( $posts as $post ):

        setup_postdata( $post )

        ?>

      <?php get_the_permalink(); ?>
      <a href="<?php get_the_permalink();?>"><?php the_title(); ?></a>

          <?php echo the_excerpt(); ?>

      </a>




      <?php endforeach; ?>


      <?php wp_reset_postdata(); ?>

    <?php endif; ?>
