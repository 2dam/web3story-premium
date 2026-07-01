<?php
/**
 * 일반 페이지 템플릿
 */
get_header();

while ( have_posts() ) : the_post();
?>
<article class="entry">
	<header class="entry-header">
		<h1><?php the_title(); ?></h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
<?php
endwhile;
get_footer();
?>
