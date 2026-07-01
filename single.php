<?php
/**
 * 개별 글 템플릿
 */
get_header();

while ( have_posts() ) : the_post();
?>
<article class="entry">
	<header class="entry-header">
		<?php $cat = get_the_category(); if ( $cat ) : ?>
			<a class="cat" href="<?php echo esc_url( get_category_link( $cat[0] ) ); ?>"><?php echo esc_html( $cat[0]->name ); ?></a>
		<?php endif; ?>
		<h1><?php the_title(); ?></h1>
		<div class="meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>

<section class="section" style="padding-top:0">
	<div class="container">
		<div class="sec-head"><h2>관련 글</h2></div>
		<div class="grid-3">
			<?php
			$related = new WP_Query( array(
				'posts_per_page'      => 3,
				'post__not_in'        => array( get_the_ID() ),
				'category__in'        => wp_get_post_categories( get_the_ID() ),
				'ignore_sticky_posts' => true,
			) );
			while ( $related->have_posts() ) : $related->the_post();
			?>
			<article class="post-card">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="thumb"><?php the_post_thumbnail( 'medium_large' ); ?></a>
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="meta"><?php echo esc_html( get_the_date() ); ?></div>
				<a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php
endwhile;
get_footer();
?>
