<?php get_header(); ?>

<main role="main" class="main-container">
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article class="container">
        <header>
          <h1 class="mb-5"><?php the_title(); ?></h1>
        </header>
        <?php the_content(); ?>
      </article>
  <?php endwhile; else: ?>
    <article>
      <p>Nothing to see.</p>
    </article>
  <?php endif; ?>
</main>

<?php get_footer();
