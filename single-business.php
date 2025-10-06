<?php
/**
 * The template for displaying the single business page
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
							'width'  => 1000,
							'height' => 500,
						)
					);
					?>
				<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_image_sample.jpg" alt="サンプル画像"
					width="1000" height="500" />
				<?php endif; ?>
			</div>
			<div class="c-sub-kv-content">
				<div class="c-sub-kv-content-inner">
					<div class="c-sub-kv-titles">
						<span class="c-sub-kv-title-en">business</span>
						<span class="c-sub-kv-title-ja">事業紹介</span>
					</div>
					<span class="c-sub-kv-date u-hidden"></span>
				</div>
				<h1 class="c-sub-kv-main-title"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<!-- /sub-kv--has-image -->

	<!-- breadcrumb -->
			<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<div class="business-contents-wrapper l-container">
		<!-- business menu -->
		<aside class="business-contents-menu" role="region" aria-label="ビジネスメニュー">
			<div class="business-contents-menu-inner">
				<div class="business-contents-menu-title">
					<span class="business-contents-menu-title-en">menu</span>
					<h2 class="business-contents-menu-title-ja">メニュー</h2>
				</div>
				<?php echo do_shortcode( '[ez-toc]' ); ?>
			</div>
		</aside>
		<!-- /business menu -->

		<!-- business-contents -->
		<div class="business-contents-main">
			<section class="business-contents-section">
				<?php the_content(); ?>
			</section>
		</div>
		<!-- /business-contents-main -->
	</div>
			<?php
		endwhile;
	endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>
