<?php
/**
 * Template Name: Top
 *
 * @package MORISITA-Corporation
 */

?>

<?php get_header(); ?>

<!-- top-kv -->
<div class="top-kv js-scrollTarget" id="page-top">
	<div class="top-kv-splide-container">
		<div class="splide js-top-kv-splide" role="group" aria-label="トップ画像スライダー">
			<div class="splide__track top-kv-splide-track">
				<ul class="splide__list">
					<li class="splide__slide top-kv-splide-slide">
						<picture>
							<source type="image/webp" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_380.webp   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_760.webp   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_1440.webp 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_2880.webp 2880w
							" sizes="(min-width:1024px) 1440px, 380px" />
							<img width="380" height="247"
								src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_380.jpg" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_380.jpg   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_760.jpg   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_1440.jpg 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_2880.jpg 2880w
							" sizes="(min-width:1024px) 1440px, 380px" alt="工場で工具を手に取る整備士の手元にある特殊ボルトナット" decoding="async"
								fetchpriority="high" />
						</picture>
					</li>
					<li class="splide__slide top-kv-splide-slide">
						<picture>
							<source type="image/webp" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_380.webp   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_760.webp   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_1440.webp 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_2880.webp 2880w
							" sizes="(min-width:1024px) 1440px, 380px" />
							<img width="380" height="247"
								src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_380.jpg" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_380.jpg   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_760.jpg   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_1440.jpg 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_02_2880.jpg 2880w
							" sizes="(min-width:1024px) 1440px, 380px" alt="テーブルの上に散らばった金属製のボルトとナット" decoding="async"
								fetchpriority="high" />
						</picture>
					</li>
					<li class="splide__slide top-kv-splide-slide">
						<picture>
							<source type="image/webp" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_380.webp   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_760.webp   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_1440.webp 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_2880.webp 2880w
							" sizes="(min-width:1024px) 1440px, 380px" />
							<img width="380" height="247"
								src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_380.jpg" srcset="
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_380.jpg   380w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_760.jpg   760w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_1440.jpg 1440w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/img/kv_03_2880.jpg 2880w
							" sizes="(min-width:1024px) 1440px, 380px" alt="工場内でスパナを持ち整備する整備士の手元" decoding="async" fetchpriority="high" />
						</picture>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="top-kv-inner">
		<div class="l-container">
			<div class="top-kv-progress js-top-kv-progress">
				<span class="top-kv-progress-number js-top-kv-progress-number">01</span>
			</div>
			<p class="top-kv-copy">
				<span class="top-kv-copy-ja">
					<span>特殊ボルトナット制作の</span>
					<span>プロフェッショナル</span>
				</span>
				<span class="top-kv-copy-en">Special bolt and nut production professionals</span>
			</p>
		</div>
	</div>
</div>
<!-- /kv -->

<!-- main -->
<main>
	<!-- news -->
	<section class="top-news">
		<div class="top-news-inner">
			<div class="top-news-title">
				<span class="top-news-title-en">news</span>
				<h2 class="top-news-title-ja">お知らせ</h2>
			</div>
			<ul class="top-news-list">
				<?php
				$args       = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$news_query = new WP_Query( $args );
				if ( $news_query->have_posts() ) :
					while ( $news_query->have_posts() ) :
						$news_query->the_post();
						?>
				<li class="top-news-list-item">
					<article>
						<a href="<?php the_permalink(); ?>" class="top-news-list-link">
							<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
								class="top-news-list-link-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
							<h3 class="top-news-list-link-title">
								<?php the_title(); ?>
							</h3>
						</a>
					</article>
				</li>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</ul>
			<div class="top-news-button">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"
					class="c-button c-button--small">VIEW
					MORE<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</section>
	<!-- /news -->

	<!-- business -->
	<section class="top-business">
		<div class="top-business-image">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/image_business.jpg"
				alt="ボルト製造工場で大型設備の下部を点検・整備する作業員" width="968" height="646" />
		</div>
		<div class="top-business-content">
			<div class="top-business-title">
				<span class="top-business-title-en">business</span>
				<h2 class="top-business-title-ja">事業紹介</h2>
			</div>
			<p class="top-business-copy">
				<span class="u-break-line-only-sp">高品質な</span><span class="u-break-line-only-sp">ボルトナットで、</span>
				<span class="u-break-line">世界を支える。</span>
			</p>
			<p class="top-business-text">
				<span class="u-break-line">どんな環境にも、最適なソリューション。</span>
				<span class="u-break-line">豊富な経験と技術力で、お客様のニーズに答える製品づくりをしています。</span>
			</p>
			<ul class="top-business-list">
				<?php
				$business_posts = get_posts(
					array(
						'post_type'      => 'business',
						'posts_per_page' => -1,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
					)
				);
				if ( $business_posts ) :
					foreach ( $business_posts as $business_post ) :
						?>
				<li class="top-business-list-item">
					<a href="<?php echo esc_url( get_permalink( $business_post->ID ) ); ?>"
						class="top-business-list-link"
						aria-label="<?php echo esc_attr( get_the_title( $business_post->ID ) ); ?>">
						<span class="top-business-list-link-title">
							<?php echo esc_html( get_the_title( $business_post->ID ) ); ?>
						</span>
						<span class="top-business-list-link-icon">
							<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
						</span>
					</a>
				</li>
				<?php
					endforeach;
				endif;
				?>
			</ul>
		</div>
	</section>
	<!-- /business -->

	<!-- product -->
	<section class="top-product">
		<div class="top-product-inner">
			<div class="top-product-header">
				<div class="top-product-title">
					<span class="top-product-title-en">product</span>
					<h2 class="top-product-title-ja">製品紹介</h2>
				</div>
				<p class="top-product-copy">確かな品質と技術力</p>
				<p class="top-product-text">
					<span class="u-break-line">高品質・高精度のボルトナットを豊富に取り揃え。</span><span
						class="u-break-line">産業の要として、お客様のニーズに応える製品をお届けします。</span>
				</p>
			</div>
			<!-- Top product slider -->
			<div class="top-product-splide-container">
				<div class="splide js-top-product-splide" role="group" aria-label="製品紹介スライダー">
					<div class="splide__track top-product-splide-track">
						<ul class="splide__list top-product-splide-list">
							<?php
							// product投稿を最新5件取得.
							$products = get_posts(
								array(
									'post_type'      => 'product',
									'posts_per_page' => 5,
									'orderby'        => 'date',
									'order'          => 'DESC',
								)
							);

							if ( $products ) :
								foreach ( $products as $product ) :
									// アイキャッチ画像を取得.
									$thumbnail_id = get_post_thumbnail_id( $product->ID );
									$image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'full' ) : get_template_directory_uri() . '/img/img_sample.jpg';

									// 画像のalt属性を取得.
									$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
									$alt_text      = $thumbnail_alt ? $thumbnail_alt : $product->post_title;

									// product_useタクソノミーからカテゴリーを取得.
									$terms    = get_the_terms( $product->ID, 'product_use' );
									$category = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : 'その他'; // デフォルト値.
									?>
							<li class="splide__slide top-product-splide-slide c-product-item">
								<a href="<?php echo esc_url( get_permalink( $product->ID ) ); ?>"
									class="c-product-item-link">
									<div class="c-product-item-image c-product-item-image--bg-color">
										<img src="<?php echo esc_url( $image_url ); ?>"
											alt="<?php echo esc_attr( $alt_text ); ?>" width="808" height="539" />
									</div>
									<div class="c-product-item-content">
										<span class="c-product-item-category c-product-item-category--bg-color">
											<?php echo esc_html( $category ); ?>
										</span>
										<p class="c-product-item-title c-product-item-title--bg-color">
											<?php echo esc_html( $product->post_title ); ?>
										</p>
									</div>
								</a>
							</li>
							<?php
								endforeach;
							else :
								?>
							<li class="splide__slide">
								<p>製品はまだありません。</p>
							</li>
							<?php
							endif;
							?>
						</ul>
					</div>
					<div class="splide__arrows top-product-splide-arrows">
						<button class="splide__arrow splide__arrow--prev top-product-splide-button-prev" type="button"
							aria-label="前のスライド">
							<span class="c-triangle c-triangle--splide-button-prev" aria-hidden="true"></span>
						</button>
						<button class="splide__arrow splide__arrow--next top-product-splide-button-next" type="button"
							aria-label="次のスライド">
							<span class="c-triangle c-triangle--splide-button-next" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</div>

			<!-- /Top product slider -->
			<div class="top-product-button">
				<a href="<?php echo esc_url( home_url( '/product' ) ); ?>" class="c-button c-button--transparent">VIEW
					MORE<span class="c-triangle c-triangle--button c-triangle--button-transparent"
						aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</section>
	<!-- /product -->

	<!-- subpages -->
	<section class="top-subpages l-container">
		<ul class="top-subpages-list">
			<li class="top-subpages-list-item">
				<a href="<?php echo esc_url( home_url( '/company' ) ); ?>" class="top-subpages-list-link">
					<div class="top-subpages-list-item-inner">
						<div class="top-subpages-list-title">
							<span class="top-subpages-list-title-en">company</span>
							<h2 class="top-subpages-list-title-ja">会社概要</h2>
						</div>
						<p class="top-subpages-list-text">
							事業内容、経営方針など、
							当社を深く知っていただくための情報をご紹介します。
						</p>
						<div class="top-subpages-list-bottom">
							<span class="top-subpages-list-link-icon">
								<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
							</span>
						</div>
					</div>
				</a>
			</li>
			<li class="top-subpages-list-item">
				<a href="<?php echo esc_url( home_url( '/message' ) ); ?>" class="top-subpages-list-link">
					<div class="top-subpages-list-item-inner">
						<div class="top-subpages-list-title">
							<span class="top-subpages-list-title-en">message</span>
							<h2 class="top-subpages-list-title-ja">代表挨拶</h2>
						</div>
						<p class="top-subpages-list-text">
							私たちの理念と未来への展望をお伝えします。
							社長からのメッセージをご覧ください。
						</p>
						<div class="top-subpages-list-bottom">
							<span class="top-subpages-list-link-icon">
								<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
							</span>
						</div>
					</div>
				</a>
			</li>
			<li class="top-subpages-list-item">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'access' ) ); ?>"
					class="top-subpages-list-link">
					<div class="top-subpages-list-item-inner">
						<div class="top-subpages-list-title">
							<span class="top-subpages-list-title-en">access</span>
							<h2 class="top-subpages-list-title-ja">アクセス</h2>
						</div>
						<p class="top-subpages-list-text">
							本社工場や営業所の所在地、
							詳細な地図と交通手段をご確認いただけます。
						</p>
						<div class="top-subpages-list-bottom">
							<span class="top-subpages-list-link-icon">
								<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
							</span>
						</div>
					</div>
				</a>
			</li>
		</ul>
	</section>
	<!-- /subpages -->
</main>
<!-- /main -->


<?php get_footer(); ?>