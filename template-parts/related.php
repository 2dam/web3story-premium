<?php
$tags = wp_get_post_tags(get_the_ID(), ['fields' => 'ids']);
if (empty($tags)) return;

$related = new WP_Query([
    'posts_per_page'      => 3,
    'post__not_in'        => [get_the_ID()],
    'tag__in'             => $tags,
    'ignore_sticky_posts' => 1
]);

if (!$related->have_posts()) return;
?>
<section class="related-posts">
    <h3 class="related-title">관련 글</h3>
    <div class="related-grid">
    <?php while ($related->have_posts()): $related->the_post(); ?>
    <article class="web3-card">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('web3-card'); ?></a>
        <div class="web3-card-body">
            <div class="web3-card-category"><?php the_category(', '); ?></div>
            <h4 class="web3-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="web3-card-footer">
                <span><?php echo get_the_date(); ?></span>
                <span><?php echo web3_reading_time(); ?></span>
            </div>
        </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
