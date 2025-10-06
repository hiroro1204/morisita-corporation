<?php
/**
 * The template for displaying the single product page
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
				<?php
				if ( has_post_thumbnail() ) :
					?>
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
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/image_sample.jpg"
					alt="森下コーポレーションのサンプル画像" width="968" height="647" class="js-main-image" />
				<?php endif; ?>
			</div>

			<div class="c-sub-kv-content">
				<div class="c-sub-kv-content-inner">
					<div class="c-sub-kv-titles">
						<span class="c-sub-kv-title-en">product</span>
						<span class="c-sub-kv-title-ja">製品紹介</span>
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

	<!-- product-content -->
	<div class="product-content u-ptb u-ptb--sub-kv-has-image l-container-s">
			<?php
				// ACFの画像フィールドを配列形式で取得（ID, URL, altが含まれる）.
				$images = array(
					'product_img01' => get_field( 'product_img01' ),
					'product_img02' => get_field( 'product_img02' ),
					'product_img03' => get_field( 'product_img03' ),
				);

				// 空の要素を除外.
				$filtered_images = array_filter( $images );

				// 最初の画像をメインに.
				$first_image = ! empty( $filtered_images ) ? reset( $filtered_images ) : null;
				?>

			<?php if ( ! empty( $filtered_images ) ) : ?>
		<!-- メイン画像 -->
		<div class="product-content-main-image js-product-main-image">
			<img src="<?php echo esc_url( $first_image['url'] ); ?>"
				alt="<?php echo esc_attr( $first_image['alt'] ? $first_image['alt'] : get_the_title() ); ?>"
				class="js-main-image">
		</div>

		<!-- サムネイル群 -->
		<ul class="product-content-thumbnails js-product-thumbnails">
				<?php $index = 0; ?>
				<?php foreach ( $filtered_images as $field_name => $image ) : ?>
					<?php if ( ! empty( $image['url'] ) ) : ?>
			<li class="product-content-thumbnail-item">
				<button class="product-content-thumbnail js-thumbnail <?php echo 0 === $index ? 'is-active' : ''; ?>"
					data-image-url="<?php echo esc_url( $image['url'] ); ?>"
					data-alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : get_the_title() ); ?>"
					data-index="<?php echo esc_attr( $index ); ?>"
					aria-label="画像 <?php echo esc_attr( $index + 1 ); ?> を表示">
					<img src="<?php echo esc_url( $image['url'] ); ?>"
						alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : get_the_title() ); ?>">
				</button>
			</li>
						<?php ++$index; ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<div class="product-content-table">
			<table class="c-table">
				<caption class="u-visually-hidden">
					<?php the_title(); ?>
				</caption>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">製品名</th>
					<td class="c-table-data"><?php the_title(); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">製品コード</th>
					<td class="c-table-data"><?php the_field( 'product_code' ); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">材質</th>
					<td class="c-table-data"><?php the_field( 'material' ); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">サイズ（直径 x 長さ）</th>
					<td class="c-table-data"><?php the_field( 'size' ); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">ドライブタイプ</th>
					<td class="c-table-data"><?php the_field( 'drive_type' ); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">用途</th>
					<td class="c-table-data"><?php the_field( 'usage' ); ?></td>
				</tr>

				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head">パッケージ単位（入数）</th>
					<td class="c-table-data"><?php the_field( 'package_unit' ); ?></td>
				</tr>

				<?php
					// 追加用ACFフィールド (最大3ペア).
				for ( $i = 1; $i <= 3; $i++ ) :
					$label   = get_field( "product_block{$i}_label" );
					$content = get_field( "product_block{$i}_content" );

					// 両方入力されている場合のみ出力.
					if ( $label && $content ) :
						?>
				<tr class="c-table-row c-table-row--product">
					<th class="c-table-head"><?php echo esc_html( $label ); ?></th>
					<td class="c-table-data"><?php echo esc_html( $content ); ?></td>
				</tr>
						<?php
						endif;
					endfor;
				?>
			</table>
		</div>
	</div>
	<!-- /product-content -->
			<?php
				endwhile;
			endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>
