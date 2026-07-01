<?php get_header(); ?>
<main class="site-main archive-page">
    <header class="archive-header">
        <div class="container">
            <?php the_archive_title('<h1 class="archive-title">', '</h1>'); ?>
            <?php the_archive_description('<p class="archive-desc">', '</p>'); ?>
        </div>
    </header>
    <div class="container archive-wrap">
        <div class="posts-grid">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article class="web3-card">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('web3-card'); ?></a>
            <div class="web3-card-body">
                <div class="web3-card-category"><?php the_category(', '); ?></div>
                <h2 class="web3-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="web3-card-text"><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
                <div class="web3-card-footer">
                    <span><?php echo get_the_date(); ?></span>
                    <span><?php echo web3_reading_time(); ?></span>
                </div>
            </div>
        </article>
        <?php endwhile; ?>
        </div>
        <div class="pagination"><?php the_posts_pagination(['mid_size' => 2]); ?></div>
        <?php else: ?>
        <p class="no-posts">글이 없습니다.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
