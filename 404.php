<?php

get_header(); ?>

<style>
    @keyframes spin {
      0% {
        transform: translateY(-4rem);
      }
      100% {
        transform: translateY(0);
      }
    }

    .slot-machine-container {
      display: inline-flex;
      overflow: hidden;
    }

    .slot {
      transform: translateY(-4rem);
      display: block;
      font-size: 4rem;
      line-height: 1;
      height: 4rem;
      animation: spin 2.5s infinite cubic-bezier(.1, .65, .1, .75);
    }

    .slot:nth-child(1) {
      animation-delay: 0s;
    }

    .slot:nth-child(2) {
      animation-delay: 0.5s;
    }

    .slot:nth-child(3) {
      animation-delay: 1s;
    }

    .slot:nth-child(4) {
      animation-delay: 1.5s;
    }
    .slot:nth-child(5) {
      animation-delay: 2s;
    }
  </style>

<section class="hero__section fx--center">
   <div class="underlay"></div>

   <img id="top-image" src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/hamish-weir-Y61qTmRLcho-unsplash.jpg' ?>" alt="<?php echo esc_attr__('&#8220;Roses Trémières&#8221; by Hamish Weir', 'impression') ?>" class="hero--img" />
   <div class="overlay--404">
      <h1>404</h1>
      <div class="slot-machine-container">
         <span class="slot">L</span>
         <span class="slot">o</span>
         <span class="slot">r</span>
         <span class="slot">e</span>
         <span class="slot">m</span>
      </div>
   </div>
</section>

<?php get_footer(); ?>