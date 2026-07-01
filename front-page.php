<?php
/**
 * 홈(프론트) 페이지 — Rooted 스타일
 */
get_header();
?>

<!-- Hero -->
<div class="container hero">
	<div class="hero-card">
		<span class="hero-badge">🚀 Web3 · AI · Blockchain</span>
		<h1>미래 기술을 가장 쉽게 이해하는 Web3 미디어</h1>
		<p class="sub">블록체인, AI, 비트코인, 토큰화 자산, Web3 기술을 깊이 있지만 쉽게 설명합니다.</p>
		<div class="hero-actions">
			<a href="#newsletter" class="btn btn-primary">뉴스레터 구독</a>
			<a href="#articles" class="btn btn-ghost">최신 글 보기</a>
		</div>
	</div>
</div>

<!-- Feature strip -->
<div class="strip container">
	<div><svg viewBox="0 0 24 24" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>블록체인 심층 분석</div>
	<div><svg viewBox="0 0 24 24" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>매주 업데이트되는 리서치</div>
	<div><svg viewBox="0 0 24 24" stroke-width="1.8"><path d="M12 3l7 4v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V7l7-4z"/></svg>쉽고 신뢰할 수 있는 해설</div>
</div>

<!-- Live briefing: 실시간 뉴스 + 발행기관 영상 -->
<section class="section live-section" id="live" style="padding-top:20px">
	<div class="container">
		<div class="sec-head">
			<h2>라이브 브리핑</h2>
			<p>실시간 암호화폐 뉴스와 주요 발행기관의 최신 영상을 한곳에서 확인하세요.</p>
		</div>
		<div class="live-grid">
			<div class="live-panel news-panel">
				<h3>📰 실시간 암호화폐 뉴스</h3>
				<ul class="news-list">
					<?php
					$w3s_news = w3s_live_news( 8 );
					if ( $w3s_news ) :
						foreach ( $w3s_news as $n ) :
					?>
					<li>
						<a href="<?php echo esc_url( $n['url'] ); ?>" target="_blank" rel="noopener nofollow"><?php echo esc_html( $n['title'] ); ?></a>
						<span class="news-meta"><?php echo esc_html( $n['source'] ); ?><?php if ( $n['time'] ) : ?> · <?php echo esc_html( human_time_diff( $n['time'], current_time( 'timestamp' ) ) ); ?> 전<?php endif; ?></span>
					</li>
					<?php endforeach; else : ?>
					<li><span class="news-meta">뉴스를 불러오는 중입니다. 잠시 후 새로고침해 주세요.</span></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="live-panel video-panel">
				<h3>🎥 발행기관 최신 영상</h3>
				<?php
				$w3s_videos = w3s_issuer_videos( 1 );
				if ( $w3s_videos ) :
					$w3s_first = array_shift( $w3s_videos );
				?>
				<div class="video-embed">
					<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $w3s_first['id'] ); ?>" title="<?php echo esc_attr( $w3s_first['title'] ); ?>" loading="lazy" allowfullscreen frameborder="0"></iframe>
				</div>
				<div class="video-caption"><strong><?php echo esc_html( $w3s_first['channel'] ); ?></strong> · <?php echo esc_html( $w3s_first['title'] ); ?></div>
				<ul class="video-list">
					<?php foreach ( array_slice( $w3s_videos, 0, 3 ) as $v ) : ?>
					<li>
						<a href="<?php echo esc_url( 'https://www.youtube.com/watch?v=' . $v['id'] ); ?>" target="_blank" rel="noopener nofollow">
							<img src="<?php echo esc_url( 'https://i.ytimg.com/vi/' . $v['id'] . '/mqdefault.jpg' ); ?>" alt="" loading="lazy">
							<span><span class="vt"><?php echo esc_html( $v['title'] ); ?></span><span class="vc"><?php echo esc_html( $v['channel'] ); ?> · <?php echo esc_html( human_time_diff( $v['time'], current_time( 'timestamp' ) ) ); ?> 전</span></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php else : ?>
				<p class="news-meta">영상을 불러오는 중입니다. 잠시 후 새로고침해 주세요.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Latest articles -->
<section class="section" id="articles">
	<div class="container">
		<div class="sec-head">
			<h2>최신 글</h2>
			<p>Web3와 AI 세계의 가장 중요한 흐름을 골라 쉽게 풀어드립니다.</p>
		</div>
		<div class="grid-3">
			<?php
			$latest = new WP_Query( array( 'posts_per_page' => 6, 'ignore_sticky_posts' => true ) );
			while ( $latest->have_posts() ) : $latest->the_post();
			?>
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
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="center">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/블로그/' ) ); ?>" class="btn btn-primary">전체 글 보기</a>
		</div>
	</div>
</section>

<!-- Topics -->
<section class="section" id="topics" style="padding-top:0">
	<div class="container">
		<div class="sec-head">
			<h2>주제 탐색</h2>
			<p>Web3Story의 핵심 카테고리에서 실용적인 인사이트를 만나보세요.</p>
		</div>
		<div class="grid-2">
			<?php
			$icons = array(
				'<svg viewBox="0 0 24 24" stroke-width="1.6"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a4 4 0 018 0v2"/></svg>',
				'<svg viewBox="0 0 24 24" stroke-width="1.6"><circle cx="12" cy="12" r="3"/><path d="M12 2v4M12 18v4M2 12h4M18 12h4M5 5l2.5 2.5M16.5 16.5L19 19M19 5l-2.5 2.5M7.5 16.5L5 19"/></svg>',
				'<svg viewBox="0 0 24 24" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 6v1.7M12 16.3V18M14.5 9c-.4-.8-1.4-1.3-2.5-1.3-1.5 0-2.7.9-2.7 2.1 0 2.7 5.6 1.4 5.6 4.1 0 1.2-1.2 2.1-2.9 2.1-1.3 0-2.4-.6-2.8-1.5"/></svg>',
				'<svg viewBox="0 0 24 24" stroke-width="1.6"><path d="M12 3l8 4v5c0 5-3.5 8.5-8 9-4.5-.5-8-4-8-9V7l8-4z"/><path d="M9 12l2 2 4-4"/></svg>',
			);
			$topics = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 4 ) );
			foreach ( $topics as $i => $t ) :
			?>
			<div class="topic">
				<?php echo $icons[ $i % 4 ]; // phpcs:ignore ?>
				<h3><?php echo esc_html( $t->name ); ?></h3>
				<p><?php echo esc_html( $t->description ? $t->description : $t->name . ' 관련 글 ' . $t->count . '편을 만나보세요.' ); ?></p>
				<a class="read-more" href="<?php echo esc_url( get_category_link( $t ) ); ?>">Explore</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- About -->
<section class="section" id="about" style="padding-top:0">
	<div class="container about">
		<div>
			<h2>어려운 기술을,<br>누구나 이해할 수 있는 이야기로</h2>
			<p>Web3Story는 블록체인·AI·암호화폐 분야의 논문과 기관 리포트를 직접 읽고, 핵심만 골라 쉬운 언어로 전달하는 독립 미디어입니다.</p>
			<p>과장된 전망 대신 데이터와 근거를 바탕으로, 기술의 본질과 시장의 맥락을 함께 이해할 수 있도록 돕습니다.</p>
			<?php $about_page = get_page_by_path( 'about' ); ?>
			<a href="<?php echo esc_url( $about_page ? get_permalink( $about_page ) : home_url( '/about/' ) ); ?>" class="btn btn-primary" style="margin-top:12px">더 알아보기</a>
		</div>
		<div class="visual"><span>⛓️</span></div>
	</div>
</section>

<!-- Newsletter -->
<section class="section" id="newsletter" style="padding-top:0">
	<div class="container">
		<div class="newsletter">
			<h2>Web3Story 뉴스레터</h2>
			<p>매주 Web3와 AI의 핵심 소식을 이메일로 받아보세요. 광고 없이, 인사이트만 담아 보냅니다.</p>
			<?php w3s_newsletter_form(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
