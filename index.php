<?php
/**
 * The template for displaying the fallback page
 *
 * @package MORISITA-Corporation
 */

get_header();
?>

<!-- main -->
<main id="page-top">
	<!-- sub-kv -->
	<div class="c-sub-kv js-scrollTarget">
		<div class="c-sub-kv-inner l-container">
			<span class="c-sub-kv-heading-en">news</span>
			<?php if ( is_year() ) : ?>
			<h1 class="c-sub-kv-heading-ja">お知らせ - <?php echo esc_html( get_query_var( 'year' ) ); ?>年</h1>
			<?php else : ?>
			<h1 class="c-sub-kv-heading-ja">お知らせ</h1>
			<?php endif; ?>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<div class="news-contents u-ptb l-container">
		<section class="news-content-section">
			<ul class="news-contents-list">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
				<li class="news-contents-list-item">
					<article class="news-contents-list-article">
						<a href="<?php the_permalink(); ?>" class="news-contents-list-link">
							<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
								class="news-contents-list-link-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
							<h2 class="news-contents-list-link-title">
								<?php the_title(); ?>
							</h2>
						</a>
					</article>
				</li>
						<?php
					endwhile;
				else :
					?>
					<?php if ( is_year() ) : ?>
				<p class="news-contents-list-item-empty">該当する年のお知らせはございません。</p>
				<?php else : ?>
				<p class="news-contents-list-item-empty">お知らせはまだありません。</p>
				<?php endif; ?>
				<?php endif; ?>
			</ul>
			<nav class="c-pagination" aria-label="ページネーション">
				<?php get_template_part( 'template/pagination' ); ?>
			</nav>
		</section>

		<!-- news-contents-archive -->
		<aside class="news-archive-section" role="region" aria-label="ニュースアーカイブ">
			<div class="news-archive-title">
				<span class="news-archive-title-en">archives</span>
				<h2 class="news-archive-title-ja">アーカイブ</h2>
			</div>
			<ul class="news-archive-list">
				<?php
				// 現在の年を取得.
				$current_year         = (int) gmdate( 'Y' );
				$current_archive_year = get_query_var( 'year' ) ? (int) get_query_var( 'year' ) : 0;

				// ALLリンク（現在のページがアーカイブページでない場合にアクティブ）.
				$is_all_active = empty( $current_archive_year );
				?>
				<li class="news-archive-list-item<?php echo $is_all_active ? ' is-active' : ''; ?>">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"
						class="news-archive-list-link">
						<span class="news-archive-list-link-text">ALL</span>
						<span class="c-triangle c-triangle--primary" aria-hidden="true"></span>
					</a>
				</li>
				<?php
				// 過去5年分のアーカイブリンクを生成.
				for ( $i = 0; $i < 5; $i++ ) :
					$archive_year     = $current_year - $i;
					$is_year_active   = ( $current_archive_year === $archive_year );
					$year_archive_url = get_year_link( $archive_year );
					?>
				<li class="news-archive-list-item<?php echo $is_year_active ? ' is-active' : ''; ?>">
					<a href="<?php echo esc_url( $year_archive_url ); ?>" class="news-archive-list-link">
						<span class="news-archive-list-link-text"><?php echo esc_html( $archive_year ); ?><span
								class="news-archive-list-link-unit">年</span></span>
						<span class="c-triangle c-triangle--primary" aria-hidden="true"></span>
					</a>
				</li>
				<?php endfor; ?>
			</ul>
		</aside>
		<!-- /news-contents-archive -->
	</div>
	<!-- /news-contents -->

</main>
<!-- /main -->

<?php get_footer(); ?>
