<?php
get_header();
?>
<main class="<?php echo esc_attr( get_post_field( 'post_name', get_post() ) ); ?>">

   <?php
   $mast = get_field('mast');
   set_query_var('mast_data', $mast);
   get_template_part('template-parts/frontpage/section', 'mast'); ?>

   <?php
   $args = array(
      'post_type'      => 'post',
      'posts_per_page' => 5,
      'orderby'        => 'date',
      'order'          => 'DESC'
   );
   $query = new WP_Query($args);
   if ($query->have_posts()) : ?>
      <section id="news-events">
         <div class="page-width">
            <h2 class="main--title">
               News & Events
            </h2>
         </div>
         <div class="news-container">
            <?php $query->the_post(); ?>
            <div class="col--left">
               <?php get_template_part('template-parts/content/article', 'featured'); ?>
            </div><!-- .left -->
            <?php if ($query->have_posts()) : ?>
               <div class="col--right">
                  <div class="float-article-wrap">
                     <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php get_template_part('template-parts/content/article', 'elem'); ?>
                     <?php endwhile; ?>
                  </div>
               </div><!-- .right -->
            <?php endif; ?>
         </div>
      </section>

   <?php wp_reset_postdata();
   endif; ?>
</main>

<?php get_footer(); ?>