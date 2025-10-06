<?php
/**
 * The template for displaying the product archive page
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
			<span class="c-sub-kv-heading-en">product</span>
			<h1 class="c-sub-kv-heading-ja">製品紹介</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- product-archive -->
	<div class="product-archive u-ptb l-container">
		<ul class="product-archive-list">
			<?php
			// 製品アーカイブページの投稿数を9件に制限.
			$current_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args          = array(
				'post_type'      => 'product',
				'posts_per_page' => 9,
				'paged'          => $current_paged,
			);
			$the_query     = new WP_Query( $args );

			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					// カテゴリー取得.
					$terms         = get_the_terms( get_the_ID(), 'product_use' );
					$category_name = '';
					if ( $terms && ! is_wp_error( $terms ) ) {
						$category_name = esc_html( $terms[0]->name );
					}
					// アイキャッチ画像取得.
					if ( has_post_thumbnail() ) {
						$thumbnail_id  = get_post_thumbnail_id();
						$image_url     = get_the_post_thumbnail_url( get_the_ID(), 'large' );
						$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
						$image_alt     = $thumbnail_alt ? $thumbnail_alt : get_the_title();
					} else {
						$image_url = get_template_directory_uri() . '/img/image_sample.jpg';
						$image_alt = '森下コーポレーションのサンプル画像';
					}
					?>
			<li class="c-product-item">
				<article class="c-product-item-article">
					<a href="<?php the_permalink(); ?>" class="c-product-item-link"
						aria-label="製品詳細: <?php echo esc_attr( get_the_title() ); ?>">
						<div class="c-product-item-image">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>"
								width="808" height="539" />
						</div>
						<div class="c-product-item-content">
							<?php if ( $category_name ) : ?>
							<span class="c-product-item-category"><?php echo esc_html( $category_name ); ?></span>
							<?php endif; ?>
							<h2 class="c-product-item-title"><?php the_title(); ?></h2>
						</div>
					</a>
				</article>
			</li>
			<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
			<li>製品が見つかりませんでした。</li>
			<?php endif; ?>
		</ul>
		<nav class="c-pagination" aria-label="ページネーション">
			<?php get_template_part( 'template/pagination' ); ?>
		</nav>
	</div>
	<!-- /product-archive -->
</main>
<!-- /main -->

<?php get_footer(); ?>