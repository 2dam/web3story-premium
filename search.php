<?php get_header(); ?>
<main class="site-main search-page">
    <div class="container">
        <header class="search-header">
            <h1>검색 결과: <em><?php echo esc_html(get_search_query()); ?></em></h1>
            <?php get_search_form(); ?>
        </header>
        <?php if (have_posts()): ?>
        <div class="posts-grid">
        <?php while (have_posts()): the_post(); ?>
        <article class="web3-card">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('web3-card'); ?></a>
            <div class="web3-card-body">
                <div class="web3-card-category"><?php the_category(', '); ?></div>
                <h2 class="web3-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="web3-card-text"><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
                <div class="web3-card-footer"><span><?php echo get_the_date(); ?></span></div>
            </div>
        </article>
        <?php endwhile; ?>
        </div>
        <div class="pagination"><?php the_posts_pagination(['mid_size' => 2]); ?></div>
        <?php else: ?>
        <div class="no-results">
            <h2>검색 결과가 없습니다.</h2>
            <p>"<?php echo esc_html(get_search_query()); ?>"에 해당하는 글을 찾지 못했습니다.</p>
            <?php get_search_form(); ?>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
