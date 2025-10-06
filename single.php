<?php
/**
 * The template for displaying the single post page
 *
 * @package MORISITA-Corporation
 */

?>

<?php get_header(); ?>

<!-- main -->
<main id="page-top">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
	<!-- sub-kv--has-image -->
	<div class="c-sub-kv c-sub-kv--has-image js-scrollTarget">
		<div class="c-sub-kv-inner l-container">
			<div class="c-sub-kv-image">
				<?php if ( has_post_thumbnail() ) : ?>
				<?php
					// アイキャッチ画像のalt属性を取得.
					$thumbnail_id  = get_post_thumbnail_id();
					$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					$alt_text      = $thumbnail_alt ? $thumbnail_alt : get_the_title();

					the_post_thumbnail(
						'full',
						array(
							'alt'    => $alt_text,
							'width'  => 968,
							'height' => 647,
						)
					);
					?>
				<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/image_sample.jpg" alt="サンプル画像"
					width="968" height="647" />
				<?php endif; ?>
			</div>
			<div class="c-sub-kv-content">
				<div class="c-sub-kv-content-inner">
					<div class="c-sub-kv-titles">
						<span class="c-sub-kv-title-en">news</span>
						<span class="c-sub-kv-title-ja">お知らせ</span>
					</div>
					<time datetime="<?php the_time( 'Y-m-d' ); ?>"
						class="c-sub-kv-date"><?php the_time( 'Y.m.d' ); ?></time>
				</div>
				<h1 class="c-sub-kv-main-title">
					<?php the_title(); ?>
				</h1>
			</div>
		</div>
	</div>
	<!-- /sub-kv--has-image -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- news-single -->
	<div class="news-single u-ptb u-ptb--sub-kv-has-image l-container-s">
		<div class="news-single-contents">
			<?php the_content(); ?>
		</div>

		<div class="news-single-buttons">
			<?php
			// 前の投稿（新しい投稿）を取得.
			$prev_post = get_previous_post();
			// 次の投稿（古い投稿）を取得.
			$next_post = get_next_post();
			?>

			<!-- 前の投稿がある場合はボタンを表示する. -->
			<?php if ( $prev_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"
				class="c-button c-button--small c-button--reverse"
				aria-label="前の記事: <?php echo esc_attr( get_the_title( $prev_post->ID ) ); ?>">
				<span class="news-single-button-text">prev</span>
				<span class="c-triangle c-triangle--button c-triangle--rotate-180" aria-hidden="true"></span>
			</a>
			<?php else : ?>
			<!-- 前の投稿がない場合はc-button--disabledを追加して非表示. -->
			<div class="c-button c-button--small c-button--reverse c-button--disabled" aria-hidden="true">
				<span class="news-single-button-text">prev</span>
				<span class="c-triangle c-triangle--button c-triangle--rotate-180" aria-hidden="true"></span>
			</div>
			<?php endif; ?>

			<!-- 次の投稿がある場合はボタンを表示する. -->
			<?php if ( $next_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="c-button c-button--small"
				aria-label="次の記事: <?php echo esc_attr( get_the_title( $next_post->ID ) ); ?>">
				<span class="news-single-button-text">next</span>
				<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
			</a>
			<?php else : ?>
			<!-- 次の投稿がない場合はc-button--disabledを追加して非表示にする. -->
			<div class="c-button c-button--small c-button--disabled" aria-hidden="true">
				<span class="news-single-button-text">next</span>
				<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- /news-single -->
	<?php
		endwhile;
	endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>