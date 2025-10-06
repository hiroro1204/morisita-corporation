<?php
/**
 * The template for displaying the message page
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
	<!-- sub-kv -->
	<div class="c-sub-kv js-scrollTarget">
		<div class="c-sub-kv-inner l-container">
			<span class="c-sub-kv-heading-en">message</span>
			<h1 class="c-sub-kv-heading-ja">代表挨拶</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- message-contents -->
	<div class="message-contents u-ptb l-container-s">
		<section class="message-section">
			<?php
			// ACF：返り値は「画像URL」.
			$pc       = get_field( 'message_hero_pc' ); // 代表写真（PC）.
			$sp       = get_field( 'message_hero_sp' ); // 代表写真（SP）.
			$ceo_name = get_field( 'message_ceo_name' ); // 代表氏名.
			?>
			<div class="message-section-image">
				<picture>
					<?php if ( $pc ) : ?>
					<source media="(min-width:768px)" srcset="<?php echo esc_url( $pc ); ?>">
					<?php endif; ?>
					<img src="<?php echo esc_url( $sp ? $sp : $pc ); ?>" alt="<?php echo esc_attr( $ceo_name ); ?>">
				</picture>
			</div>
			<!-- キャッチコピー（ACF 3行）. -->
			<?php
			$line1 = trim( (string) get_field( 'message_line1' ) );
			$line2 = trim( (string) get_field( 'message_line2' ) );
			$line3 = trim( (string) get_field( 'message_line3' ) );

			// 全行空ならフォールバック（初期のハードコード）.
			$use_fallback = ! ( $line1 || $line2 || $line3 );

			// 読み上げ用：3行を1文に結合（空は除外）.
			$aria_label = $use_fallback
			? '持続可能な未来へ、エネルギーイノベーションの先駆者として'
			: esc_attr( preg_replace( '/\s+/u', '', implode( '', array_filter( array( $line1, $line2, $line3 ) ) ) ) );
			?>

			<div class="message-section-content">
				<!-- キャッチコピー -->
				<p class="message-section-content-copy" aria-label="<?php echo esc_attr( $aria_label ); ?>">
					<?php if ( $use_fallback ) : ?>
					<span class="message-copy-primary u-break-line">持続可能な未来へ、</span>
					<span class="u-break-line-only-pc">エネルギーイノベーションの</span>
					<span class="u-break-line-only-pc">先駆者として</span>
					<?php else : ?>
					<?php if ( $line1 ) : ?>
					<span class="message-copy-primary u-break-line"><?php echo esc_html( $line1 ); ?></span>
					<?php endif; ?>
					<?php if ( $line2 ) : ?>
					<span class="u-break-line-only-pc"><?php echo esc_html( $line2 ); ?></span>
					<?php endif; ?>
					<?php if ( $line3 ) : ?>
					<span class="u-break-line-only-pc"><?php echo esc_html( $line3 ); ?></span>
					<?php endif; ?>
					<?php endif; ?>
				</p>

				<!-- 本文 -->
				<div class="message-section-content-text">
					<?php the_content(); ?>
				</div>

				<!-- 署名 -->
				<div class="message-section-sign">
					<span class="message-section-sign-title">代表取締役社長</span>
					<span class="message-section-sign-name"><?php echo esc_html( $ceo_name ); ?></span>
				</div>
			</div>
		</section>
	</div>

	<!-- /message-contents -->
	<?php
		endwhile;
	endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>