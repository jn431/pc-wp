<?php
get_header();
?>
<main>
   <?php

   $hero = get_field('hero_section_group');

   echo "<pre>";
   var_dump($hero);
   echo "</pre>";

   if ($hero): ?>
      <section class="hero__section" style="--background-tint: <?php echo $hero['background_tint']; ?>%;">
         <?php if ($hero['hero_image']) :
            echo wp_get_attachment_image($hero['hero_image']['id'], 'full', '', ['class' => 'foo bar']);
         endif; ?>
         <div class="hero__content content--<?php echo $hero['content_alignment']; ?> page-width">
            <div class="content-container">
               <h2 class="hero__title"><?php echo $hero['title']; ?></h2>
               <?php if ($hero['subtitle']) : ?>
                  <div class="hero--text">Foo bar lorem ipsum</div>
               <?php endif; ?>
            </div>
         </div>
      </section>

      <section id="news-events">
      <?php endif;

   $args = array(
      'post_type'      => 'post',
      'posts_per_page' => 5,
      'orderby'        => 'date',
      'order'          => 'DESC'   // Show latest first
   );

   $query = new WP_Query($args);

   if ($query->have_posts()) : ?>
         <div class="news_events-wrapper page-width">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
               <article class="post">
               <?php
                $categories = get_the_category();
                if (!empty($categories)) : ?>
                    <div class="post-meta">
                    <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) : ?>
                        <span class="slant-divider">/</span>
                        <span class="post-category">
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </span>
                    <?php endif; ?>
                     </div>
                <?php endif; ?>

                  <?php if (has_post_thumbnail()) : ?>
                     <a href="<?php the_permalink(); ?>">
                           <?php the_post_thumbnail('medium'); ?>
                     </a>
                  <?php endif; ?>
                  <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
               </article>
            <?php endwhile; ?>
         </div>
         <?php wp_reset_postdata(); ?>
      <?php else : ?>
         <p>No recent posts found.</p>
      <?php endif; ?>
      </section>

      <?php

      /* if (have_posts()) {

   while (have_posts()) {
   the_post();

   //get_template_part('template-parts/content/content', 'page');

   // get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));
   }
   } else {
   // If no content, include the "No posts found" template.
   get_template_part('template-parts/content/content-none');
   echo "Foo bar;";
   } */
      ?>

</main>

<?php get_footer(); ?>