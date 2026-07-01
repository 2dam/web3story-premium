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

/* ---------- 라이브 브리핑: 실시간 뉴스 + 발행기관 유튜브 ---------- */

/* 피드 캐시 5분 */
function w3s_feed_cache_5min() { return 300; }

function w3s_fetch_feed_cached( $urls ) {
	if ( ! function_exists( 'fetch_feed' ) ) {
		include_once ABSPATH . WPINC . '/feed.php';
	}
	add_filter( 'wp_feed_cache_transient_lifetime', 'w3s_feed_cache_5min' );
	$feed = fetch_feed( $urls );
	remove_filter( 'wp_feed_cache_transient_lifetime', 'w3s_feed_cache_5min' );
	return $feed;
}

/* 뉴스 소스 (한국어 + 영어 혼합) — 필터로 교체 가능 */
function w3s_news_sources() {
	return apply_filters( 'w3s_news_sources', array(
		'https://www.blockmedia.co.kr/feed',
		'https://kr.cointelegraph.com/rss',
		'https://cointelegraph.com/rss',
		'https://www.coindesk.com/arc/outboundfeeds/rss/',
	) );
}

/* 최신 뉴스 아이템 (피드별 개별 수집 — 일부 실패해도 나머지 표시) */
function w3s_live_news( $limit = 8 ) {
	$out = array();
	foreach ( w3s_news_sources() as $url ) {
		$feed = w3s_fetch_feed_cached( $url );
		if ( is_wp_error( $feed ) ) continue;
		foreach ( $feed->get_items( 0, 4 ) as $item ) {
			$src = $item->get_feed();
			$out[] = array(
				'title'  => $item->get_title(),
				'url'    => $item->get_permalink(),
				'source' => $src ? $src->get_title() : '',
				'time'   => (int) $item->get_date( 'U' ),
			);
		}
	}
	usort( $out, function ( $a, $b ) { return $b['time'] - $a['time']; } );
	return array_slice( $out, 0, $limit );
}

/* 발행기관 유튜브 채널 — 필터로 추가/교체 가능 */
function w3s_issuer_channels() {
	return apply_filters( 'w3s_issuer_channels', array(
		'UCNOfzGXD_C9YMYmnefmPH0g' => '이더리움 재단',
		'UCjok1uTSBUgvRYQaASz6YWw' => 'Ripple',
		'UC9AdQPUe4BdVJ8M9X7wxHUA' => 'Solana',
		'UCbQ9vGfezru1YRI1zDCtTGg' => '카르다노 재단',
	) );
}

/* 채널별 최신 영상 (날짜순 정렬) */
function w3s_issuer_videos( $per_channel = 1 ) {
	$videos = array();
	foreach ( w3s_issuer_channels() as $channel_id => $label ) {
		$feed = w3s_fetch_feed_cached( 'https://www.youtube.com/feeds/videos.xml?channel_id=' . $channel_id );
		if ( is_wp_error( $feed ) ) continue;
		foreach ( $feed->get_items( 0, $per_channel ) as $item ) {
			$vid = str_replace( 'yt:video:', '', $item->get_id() );
			if ( ! preg_match( '/^[A-Za-z0-9_-]{6,}$/', $vid ) ) continue;
			$videos[] = array(
				'id'      => $vid,
				'title'   => $item->get_title(),
				'channel' => $label,
				'time'    => (int) $item->get_date( 'U' ),
			);
		}
	}
	usort( $videos, function ( $a, $b ) { return $b['time'] - $a['time']; } );
	return $videos;
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
