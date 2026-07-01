<?php
/**
 * Web3Story Rooted theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function w3s_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 84, 'width' => 400, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'primary' => '상단 메뉴',
		'footer'  => '푸터 메뉴',
	) );
}
add_action( 'after_setup_theme', 'w3s_setup' );

function w3s_scripts() {
	wp_enqueue_style( 'w3s-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=Noto+Sans+KR:wght@400;500;700&display=swap', array(), null );
	wp_enqueue_style( 'w3s-style', get_stylesheet_uri(), array( 'w3s-fonts' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'w3s_scripts' );

/* 발췌 길이/말줄임 */
add_filter( 'excerpt_length', function () { return 24; } );
add_filter( 'excerpt_more', function () { return '…'; } );

/* 모바일 메뉴 토글 (인라인 소형 스크립트) */
function w3s_footer_js() { ?>
	<script>
	(function(){var b=document.querySelector('.hamburger'),n=document.querySelector('.nav-links');
	if(b&&n){b.addEventListener('click',function(){n.classList.toggle('open');});}})();
	</script>
<?php }
add_action( 'wp_footer', 'w3s_footer_js' );

/* 기본 메뉴 폴백 */
function w3s_menu_fallback() {
	echo '<ul>';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">홈</a></li>';
	$about = get_page_by_path( 'about' );
	if ( $about ) echo '<li><a href="' . esc_url( get_permalink( $about ) ) . '">About</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/블로그/' ) ) . '">블로그</a></li>';
	$contact = get_page_by_path( 'contact-us' );
	if ( $contact ) echo '<li><a href="' . esc_url( get_permalink( $contact ) ) . '">Contact</a></li>';
	echo '</ul>';
}

/* 뉴스레터 폼 출력: 플러그인 숏코드가 있으면 사용, 없으면 정적 폼 */
function w3s_newsletter_form() {
	if ( shortcode_exists( 'newsletter_form' ) ) {
		echo do_shortcode( '[newsletter_form]' );
	} else {
		echo '<form action="#" method="post" onsubmit="event.preventDefault();alert(\'구독 신청이 완료되었습니다!\');">';
		echo '<label for="w3s-email">이메일 주소</label>';
		echo '<input id="w3s-email" type="email" name="ne" placeholder="your@email.com" required>';
		echo '<button class="btn btn-primary" type="submit">구독하기</button>';
		echo '</form>';
	}
}
