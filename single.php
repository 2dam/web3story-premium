<?php get_header(); ?>
<main class="site-main">
    <?php while (have_posts()): the_post(); ?>
    <article <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_category(' '); ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <span><?php the_author(); ?></span>
                <span><?php echo get_the_date(); ?></span>
                <span><?php echo do_shortcode('[rt_reading_time]'); ?></span>
            </div>
        </header>
        <?php if (has_post_thumbnail()): ?>
        <div class="post-thumbnail"><?php the_post_thumbnail('full'); ?></div>
        <?php endif; ?>
        <div class="entry-content"><?php the_content(); ?></div>
        <?php get_template_part('template-parts/author'); ?>
        <?php get_template_part('template-parts/related'); ?>
    </article>
    <?php endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
