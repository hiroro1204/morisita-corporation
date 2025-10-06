<?php
/**
 * The template for displaying the access archive page
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
			<span class="c-sub-kv-heading-en">access</span>
			<h1 class="c-sub-kv-heading-ja">アクセス</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- access -->
	<div class="access-contents u-ptb l-container-s">
		<ul class="access-list">
			<?php if ( have_posts() ) : ?>
			<?php
				while ( have_posts() ) :
					the_post();
					?>
			<li class="access-item">
				<section class="access-item-section">
					<div class="access-item-content">
						<div class="access-item-content-info">
							<h2 class="access-item-title"><?php the_title(); ?></h2>
							<p class="access-item-address">
								<?php
										$addr = (string) get_field( 'access_address' );
										echo '' !== $addr ? nl2br( esc_html( $addr ) ) : '';
								?>
							</p>
						</div>

						<div class="access-item-button">
							<?php
									$url = get_field( 'access_map_url' );
							if ( $url ) :
								?>
							<a href="<?php echo esc_url( $url ); ?>" class="c-button c-button--small" target="_blank"
								rel="noopener" aria-label="<?php echo esc_attr( get_the_title() ); ?>の地図をGoogleマップで開く">
								GOOGLE MAP
								<span class="c-triangle c-triangle--button" aria-hidden="true"></span>
							</a>
							<?php endif; ?>
						</div>
					</div>

					<div class="access-item-map">
						<?php
							// ACFに貼った埋め込みiframe（Googleマップのみ許可）.
							$raw = get_field( 'access_map_iframe' );
						if ( $raw ) {
							$ok = false;
							if ( preg_match( '#<iframe[^>]+src=[\'"]([^\'"]+)#i', $raw, $m ) ) {
								$host          = wp_parse_url( $m[1], PHP_URL_HOST );
								$allowed_hosts = array( 'www.google.com', 'maps.google.com', 'www.google.co.jp', 'maps.google.co.jp' );
								$ok            = $host && in_array( $host, $allowed_hosts, true );
							}

							if ( $ok ) {
								$allowed = array(
									'iframe' => array(
										'src'             => true,
										'width'           => true,
										'height'          => true,
										'style'           => true,
										'title'           => true,
										'loading'         => true,
										'referrerpolicy'  => true,
										'allowfullscreen' => true,
									),
								);
								echo wp_kses( $raw, $allowed );
							}
						}
						?>
					</div>
				</section>
			</li>
			<?php endwhile; ?>
			<?php else : ?>
			<li class="access-item">
				<p>アクセス情報がありません。</p>
			</li>
			<?php endif; ?>
		</ul>

	</div>
	<!-- /access -->
</main>
<!-- /main -->

<?php get_footer(); ?>