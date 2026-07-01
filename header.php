<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container nav">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 5-3 5-3-5 3-5zM12 12l3 5-3 5-3-5 3-5z"/></svg>
				WEB3STORY
			<?php endif; ?>
		</a>
		<nav class="nav-links">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'w3s_menu_fallback',
			) );
			?>
		</nav>
		<a href="#newsletter" class="btn btn-primary">구독하기</a>
		<button class="hamburger" aria-label="메뉴 열기">&#9776;</button>
	</div>
</header>
