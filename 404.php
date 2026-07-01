<?php get_header(); ?>
<main class="site-main error-404">
    <div class="container">
        <div class="error-wrap">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">페이지를 찾을 수 없습니다</h2>
            <p class="error-desc">요청하신 페이지가 삭제되었거나 주소가 변경되었을 수 있습니다.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">홈으로 돌아가기</a>
            <div class="error-search">
                <p>또는 검색해 보세요</p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
