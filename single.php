<?php
get_header();

/* $block_content = custom_render_hero_section_block(array(
   'image' => 'URL_TO_IMAGE',
   'title' => 'Your Title',
   'subtitle' => 'Your Subtitle',
));

echo "Block content";
echo $block_content; */

?>
<main>
   <section class="page__section hero med--width">
      <?php
      if (have_posts()) {

         // Load posts loop.
         while (have_posts()) {
            the_post();

            get_template_part('template-parts/content/content', 'page');

            // get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));
         }
      } else {

         // If no content, include the "No posts found" template.
         get_template_part('template-parts/content/content-none');
         echo "No;";
      }
      ?>
   </section>
</main>

<?php get_footer(); ?>