<footer class="site-footer" id="contact">
	<div class="container">
		<div class="foot">
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 5-3 5-3-5 3-5zM12 12l3 5-3 5-3-5 3-5z"/></svg>
					WEB3STORY
				</a>
				<p class="tagline">Blockchain · AI · Crypto · Web3</p>
				<div class="socials">
					<a href="#" aria-label="X"><svg viewBox="0 0 24 24"><path d="M18.9 2H22l-6.8 7.8L23.2 22h-6.3l-4.9-6.4L6.4 22H3.3l7.3-8.3L1.5 2h6.4l4.4 5.9L18.9 2zm-1.1 18h1.7L7 3.8H5.2L17.8 20z"/></svg></a>
					<a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.9 3.9 6 2.5 6S0 4.9 0 3.5 1.1 1 2.5 1s2.48 1.1 2.48 2.5zM.2 8h4.6v14H.2V8zm7.4 0h4.4v1.9h.1c.6-1.2 2.1-2.4 4.3-2.4 4.6 0 5.5 3 5.5 7V22h-4.6v-6.6c0-1.6 0-3.6-2.2-3.6s-2.6 1.7-2.6 3.5V22H7.6V8z"/></svg></a>
				</div>
			</div>
			<div>
				<h4>메뉴</h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => 'w3s_menu_fallback',
				) );
				?>
			</div>
			<div>
				<h4>카테고리</h4>
				<ul>
					<?php wp_list_categories( array( 'title_li' => '', 'number' => 6, 'orderby' => 'count', 'order' => 'DESC' ) ); ?>
				</ul>
			</div>
			<div>
				<h4>뉴스레터</h4>
				<?php w3s_newsletter_form(); ?>
			</div>
		</div>
		<div class="copy">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Web3Story. All Rights Reserved.</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
