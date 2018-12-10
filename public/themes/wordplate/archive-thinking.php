<?php get_header(); ?>

<main role="main" class="main-container d-flex flex-column">
  <div class="flex-grow-1"></div>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article class="mt-a">
        <header>
          <h2 class="text-uppercase m-0">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h2>
        </header>
      </article>
  <?php endwhile; else: ?>
    <article>
      <p>Nothing to see.</p>
    </article>
  <?php endif; ?>
</main>

<?php get_footer();
