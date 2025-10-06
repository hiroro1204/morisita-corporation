<?php
/**
 * The footer for our theme
 *
 * @package MORISITA-Corporation
 */

?>


<!-- footer -->
<footer class="footer">
	<!-- cta -->
	<div class="footer-cta">
		<div class="footer-cta-inner">
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="footer-cta-button">
				<div class="footer-cta-icon-text">
					<span class="footer-cta-icon-text-en">contact</span>
					<span class="footer-cta-icon-text-ja">お問い合わせ</span>
				</div>
			</a>
		</div>
	</div>
	<!-- /cta -->

	<div class="footer-contents">
		<a href="#page-top" class="footer-scrolltop-btn js-scrolltop-button" aria-label="TOPへ戻る">
			<span class="c-triangle c-triangle--scrolltop" aria-hidden="true"></span>
		</a>
		<div class="footer-contents-inner l-container">
			<div class="footer-info">
				<div class="footer-info-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo_white.svg"
							alt="<?php bloginfo( 'name' ); ?>" width="300" height="90" />
					</a>
				</div>
				<p class="footer-info-address">
					〒123-4567 東京都春日区青葉町2-11-7
				</p>
				<p class="footer-info-tel">
					<span class="footer-info-tel-text">Tel.</span><a href="tel:03-1234-5678"
						class="footer-info-tel-link">03-1234-5678</a>
				</p>
				<small class="footer-copyright">© 2024 MORISITA inc.</small>
			</div>
			<nav class="footer-nav" aria-label="フッターナビゲーション">
				<div class="footer-nav-container">
					<ul class="footer-nav-list">
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-nav-text">HOME</a>
						</li>
					</ul>
					<ul class="footer-nav-list footer-nav-list--subpages">
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( home_url( '/company' ) ); ?>" class="footer-nav-link">会社概要</a>
						</li>
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( home_url( '/message' ) ); ?>" class="footer-nav-link">代表挨拶</a>
						</li>
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'access' ) ); ?>"
								class="footer-nav-link">アクセス</a>
						</li>
					</ul>
				</div>
				<div class="footer-nav-container footer-nav-container--business">
					<ul class="footer-nav-list">
						<li class="footer-nav-item">
							<span class="footer-nav-text">事業紹介</span>
							<ul class="footer-nav-sub-list">
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
								<li class="footer-nav-sub-item">
									<a href="<?php echo esc_url( get_permalink( $business_post->ID ) ); ?>"
										class="footer-nav-sub-link">
										<?php echo esc_html( get_the_title( $business_post->ID ) ); ?>
									</a>
								</li>
								<?php
									endforeach;
								endif;
								?>
							</ul>
						</li>
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>"
								class="footer-nav-link">製品紹介</a>
						</li>
					</ul>
				</div>
				<div class="footer-nav-container footer-nav-container--info">
					<ul class="footer-nav-list">
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"
								class="footer-nav-link">お知らせ</a>
						</li>
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
								class="footer-nav-link">お問い合わせ</a>
						</li>
						<li class="footer-nav-item">
							<a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>"
								class="footer-nav-link">プライバシーポリシー</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
</footer>
<!-- /footer -->

<?php wp_footer(); ?>
</body>

</html>