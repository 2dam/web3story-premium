<?php
/**
 * Web3Story Premium Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <?php if (has_custom_logo()): the_custom_logo(); else: ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>">Web3<span>Story</span></a>
            </h1>
            <?php endif; ?>
        </div>
        <nav class="main-navigation">
            <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'primary-menu']); ?>
        </nav>
        <div class="header-actions">
            <button id="dark-toggle">🌙</button>
        </div>
    </div>
</header>
<div id="content" class="site-content">
