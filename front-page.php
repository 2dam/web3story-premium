<?php
/**
 * Template Name: Front Page
 */
get_header();
?>
<main class="site-main">

<section class="web3-hero">
    <div class="hero-content">
        <span class="hero-badge">🚀 Web3 • AI • Blockchain</span>
        <h1>미래 기술을 가장 쉽게 이해하는 Web3 미디어</h1>
        <p>블록체인, AI, 비트코인, 토큰화 자산, Web3 기술을 깊이 있지만 쉽게 설명합니다.</p>
        <div class="hero-buttons">
            <a href="/category/blockchain/" class="btn">블록체인</a>
            <a href="/category/ai/" class="btn-outline">AI</a>
        </div>
    </div>
</section>

<?php
$featured = new WP_Query(['posts_per_page' => 1, 'meta_key' => 'featured', 'meta_value' => '1']);
if ($featured->have_posts()): while ($featured->have_posts()): $featured->the_post();
?>
<section class="featured-post">
    <article class="web3-card">
        <div class="featured-image">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
        </div>
        <div class="featured-content">
            <div class="cat-links"><?php the_category(' '); ?></div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo wp_trim_words(get_the_excerpt(), 35); ?></p>
            <a class="btn" href="<?php the_permalink(); ?>">계속 읽기 →</a>
        </div>
    </article>
</section>
<?php endwhile; wp_reset_postdata(); endif; ?>

<section class="latest-posts">
    <div class="section-title"><h2>최신 글</h2></div>
    <div class="posts-grid">
    <?php
    $query = new WP_Query(['post_type' => 'post', 'posts_per_page' => 9]);
    while ($query->have_posts()): $query->the_post();
    ?>
    <article class="web3-card">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
        <div class="web3-card-body">
            <div class="web3-card-category"><?php the_category(', '); ?></div>
            <h3 class="web3-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="web3-card-text"><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
            <div class="web3-card-footer">
                <span><?php echo get_the_date(); ?></span>
                <span><?php echo web3_reading_time(); ?></span>
            </div>
        </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>

<section class="newsletter-box">
    <h2>Web3Story Newsletter</h2>
    <p>매주 Web3와 AI의 핵심 소식을 받아보세요.</p>
    <?php echo do_shortcode('[newsletter_form]'); ?>
</section>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
