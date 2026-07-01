<?php
$author_id = get_the_author_meta('ID');
?>
<div class="author-box">
    <div class="author-avatar"><?php echo get_avatar($author_id, 80); ?></div>
    <div class="author-info">
        <h4 class="author-name"><?php the_author_meta('display_name'); ?></h4>
        <p class="author-bio"><?php the_author_meta('description'); ?></p>
        <a class="author-link" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">글 더 보기 →</a>
    </div>
</div>
