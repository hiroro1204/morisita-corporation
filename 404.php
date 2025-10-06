<?php
/**
 * Template Name: 404
 *
 * @package MORISITA-Corporation
 */

?>

<?php get_header(); ?>

<!-- main -->
<main id="page-top">
	<!-- sub-kv -->
	<div class="c-sub-kv js-scrollTarget">
		<div class="c-sub-kv-inner l-container">
			<span class="c-sub-kv-heading-en">404 Not Found</span>
			<h1 class="c-sub-kv-heading-ja">
				お探しのページは見つかりませんでした。
			</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- not-found-contents -->
	<div class="not-found-contents u-ptb l-container-s">
		<p class="not-found-contents-text">
			<span class="u-break-line-only-sp">申し訳ございませんが、</span><span
				class="u-break-line-only-sp">お探しのページが見つかりません。</span>
		</p>
		<p class="not-found-contents-text">
			<span class="u-break-line-only-sp">
				該当のページはアドレス変更、削除されたか、</span><span class="u-break-line-only-sp">
				一時的にアクセスできない状況にある</span><span class="u-break-line-only-sp">可能性があります。</span>
		</p>
		<div class="not-found-contents-button">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-button" aria-label="トップページに戻る">
				back to top
				<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
			</a>
		</div>
	</div>

	<!-- /not-found-contents -->
</main>
<!-- /main -->

<?php get_footer(); ?>