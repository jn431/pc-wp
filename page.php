<?php
get_header();
?>
<main>
   <?php
   if (have_posts()) {

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

</main>

<?php get_footer(); ?>