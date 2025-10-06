<?php
/**
 * The template for displaying the company page
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
			<span class="c-sub-kv-heading-en">company</span>
			<h1 class="c-sub-kv-heading-ja">会社概要</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
			<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- company-contents -->
	<div class="company-contents u-ptb">
		<div class="l-container-s">
			<?php
			$thumbnail_pc = get_field( 'company_thumbnail_pc' );
			$thumbnail_sp = get_field( 'company_thumbnail_sp' );
			$company_name = get_field( 'company_name' );
			?>
			<?php if ( $thumbnail_pc || $thumbnail_sp ) : ?>
			<div class="company-contents-thumbnail">
				<picture>
					<?php if ( $thumbnail_pc ) : ?>
					<source srcset="<?php echo esc_url( $thumbnail_pc ); ?>" media="(min-width: 768px)" />
					<?php endif; ?>
					<?php if ( $thumbnail_sp ) : ?>
					<img src="<?php echo esc_url( $thumbnail_sp ); ?>"
						alt="<?php echo esc_attr( $company_name ? $company_name . 'の外観' : '会社の外観' ); ?>" width="340"
						height="226" />
					<?php endif; ?>
				</picture>
			</div>
			<?php endif; ?>

			<div class="company-contents-table">
				<?php
				// 各フィールド取得（company_nameは上で取得済み）.
				$company_address     = get_field( 'company_address' );
				$company_ceo         = get_field( 'company_ceo' );
				$company_established = get_field( 'company_established' );
				$company_capital     = get_field( 'company_capital' );
				$company_employees   = get_field( 'company_employees' );
				$company_tel         = get_field( 'company_tel' );
				$company_business    = get_field( 'company_business' );

				// telリンク用（ハイフンなど除去）.
				$tel_link = $company_tel ? preg_replace( '/[^\d+]/', '', $company_tel ) : '';
				?>

				<table class="c-table" aria-label="会社概要">
					<caption class="u-visually-hidden">会社概要</caption>

					<?php if ( $company_name ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">会社名</th>
						<td class="c-table-data"><?php echo esc_html( $company_name ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_address ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">所在地</th>
						<td class="c-table-data"><?php echo nl2br( esc_html( $company_address ) ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_ceo ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">代表者</th>
						<td class="c-table-data"><?php echo esc_html( $company_ceo ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_established ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">設立</th>
						<td class="c-table-data"><?php echo esc_html( $company_established ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_business ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">事業内容</th>
						<td class="c-table-data">
							<?php
							// 改行で配列化.
							$lines = preg_split( '/\r\n|\r|\n/', $company_business );
							$lines = array_filter( array_map( 'trim', $lines ) ); // 空行除去.
							if ( ! empty( $lines ) ) {
								echo '<ul class="c-table-list">';
								foreach ( $lines as $line ) {
									echo '<li class="c-table-item">' . esc_html( $line ) . '</li>';
								}
								echo '</ul>';
							}
							?>
						</td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_capital ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">資本金</th>
						<td class="c-table-data"><?php echo esc_html( $company_capital ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_employees ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">従業員数</th>
						<td class="c-table-data"><?php echo esc_html( $company_employees ); ?></td>
					</tr>
					<?php endif; ?>

					<?php if ( $company_tel ) : ?>
					<tr class="c-table-row">
						<th class="c-table-head">連絡先</th>
						<td class="c-table-data">
							<a href="tel:<?php echo esc_attr( $tel_link ); ?>">
								<?php echo esc_html( $company_tel ); ?>
							</a>
						</td>
					</tr>
					<?php endif; ?>

					<?php
					// 追加用フィールド (最大3ペア).
					for ( $i = 1; $i <= 3; $i++ ) :
						$label = get_field( "company_info{$i}_label" );
						$value = get_field( "company_info{$i}_value" );

						if ( $label && $value ) :
							?>
					<tr class="c-table-row">
						<th class="c-table-head"><?php echo esc_html( $label ); ?></th>
						<td class="c-table-data"><?php echo esc_html( $value ); ?></td>
					</tr>
							<?php
		endif;
	endfor;
					?>

				</table>

			</div>
		</div>
	</div>
	<!-- /company-contents -->
			<?php
		endwhile;
	endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>
