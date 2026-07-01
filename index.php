<?php
/**
 * 블로그 목록 / 아카이브 공용 템플릿
 */
get_header();
?>

<div class="archive-header">
	<h1>
		<?php
		if ( is_home() ) {
			echo '블로그';
		} elseif ( is_search() ) {
			printf( '"%s" 검색 결과', esc_html( get_search_query() ) );
		} else {
			echo wp_kses_post( get_the_archive_title() );
		}
		?>
	</h1>
	<?php if ( ! is_home() && ! is_search() ) the_archive_description( '<p style="color:var(--muted);margin-top:10px">', '</p>' ); ?>
</div>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
		<div class="grid-3">
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="post-card">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="thumb"><?php the_post_thumbnail( 'medium_large' ); ?></a>
				<?php endif; ?>
				<?php $cat = get_the_category(); if ( $cat ) : ?>
					<span class="cat"><?php echo esc_html( $cat[0]->name ); ?></span>
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="meta"><?php echo esc_html( get_the_date() ); ?></div>
				<div class="excerpt"><?php echo esc_html( get_the_excerpt() ); ?></div>
				<a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
			</article>
			<?php endwhile; ?>
		</div>
		<nav class="pagination"><?php echo paginate_links(); // phpcs:ignore ?></nav>
		<?php else : ?>
		<p style="text-align:center;color:var(--muted)">게시글이 없습니다.</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
