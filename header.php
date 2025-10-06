<?php
/**
 * The header for our theme
 *
 * @package MORISITA-Corporation
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<meta name="format-detection" content="telephone=no" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">
	<!-- header -->
	<header id="header" class="header js-header">
		<div class="header-inner l-container">
			<?php if ( is_front_page() ) : ?>
			<h1 class="header-logo">
				<?php else : ?>
				<div class="header-logo">
					<?php endif; ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/<?php echo is_front_page() ? 'logo_white.svg' : 'logo.svg'; ?>"
							alt="<?php bloginfo( 'name' ); ?>" width="300" height="90"
							class="header-logo-img header-logo-img--initial" />
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.svg"
							alt="<?php bloginfo( 'name' ); ?>" width="300" height="90"
							class="header-logo-img header-logo-img--fixed" />
					</a>
					<?php if ( is_front_page() ) : ?>
			</h1>
			<?php else : ?>
		</div>
		<?php endif; ?>

		<button class="hamburger js-hamburger-button" type="button" aria-label="メニューを開く">
			<span class="hamburger-line"></span>
			<span class="hamburger-line"></span>
			<span class="hamburger-line"></span>
		</button>

		<!-- header menu -->
		<dialog class="header-menu js-header-menu" aria-label="メニュー">
			<div class="header-menu-head l-container">
				<div class="header-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo_white.svg"
							alt="<?php bloginfo( 'name' ); ?>" width="300" height="90" />
					</a>
				</div>
				<button class="hamburger js-hamburger-close-button" type="button" aria-label="メニューを閉じる">
					<span class="hamburger-line"></span>
					<span class="hamburger-line"></span>
					<span class="hamburger-line"></span>
				</button>
			</div>
			<nav class="header-nav" aria-label="メニュー">
				<ul class="header-nav-list">
					<li class="header-nav-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-nav-link">
							<span class="header-nav-text-en
								<?php
								if ( ! is_front_page() ) {
									echo ' header-nav-text--black';}
								?>
								">home</span>
							<span
								class="header-nav-text-ja header-nav-text-ja--small header-nav-text--hide-pc">ホーム</span>
						</a>
					</li>
					<li class="header-nav-item">
						<a href="<?php echo esc_url( home_url( '/company' ) ); ?>" class="header-nav-link">
							<span class="header-nav-text-en header-nav-text--hide-pc">company</span>
							<span class="header-nav-text-ja 
								<?php
								if ( ! is_front_page() ) {
									echo ' header-nav-text--black';}
								?>
								">会社概要</span>
						</a>
					</li>
					<li class="header-nav-item header-nav-item--business">
						<button class="header-nav-link js-dropdown-button" type="button">
							<span class="header-nav-text-en header-nav-text--hide-pc">business</span>
							<span class="header-nav-text-ja header-nav-text-ja--small 
								<?php
								if ( ! is_front_page() ) {
									echo ' header-nav-text--black';}
								?>
								">事業紹介</span>
							<span class="c-triangle c-triangle--rotate-90 c-triangle--only-pc 
								<?php
								if ( ! is_front_page() ) {
									echo 'c-triangle--black';}
								?>
								js-dropdown-button" aria-hidden="true"></span>
						</button>
						<ul class="header-nav-item-sub-list js-dropdown-menu">
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
							<li class="header-nav-item-sub-item">
								<a href="<?php echo esc_url( get_permalink( $business_post->ID ) ); ?>"
									class="header-nav-item-sub-link">
									<span><?php echo esc_html( get_the_title( $business_post->ID ) ); ?></span>
									<span class="c-triangle" aria-hidden="true"></span>
								</a>
							</li>
										<?php
									endforeach;
								endif;
								?>
						</ul>
					</li>
					<li class="header-nav-item">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>"
							class="header-nav-link">
							<span class="header-nav-text-en header-nav-text--hide-pc">product</span>
							<span class="header-nav-text-ja 
								<?php
								if ( ! is_front_page() ) {
									echo ' header-nav-text--black';}
								?>
								">製品紹介</span>
						</a>
					</li>
					<li class="header-nav-item">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'access' ) ); ?>" class="header-nav-link">
							<span class="header-nav-text-en header-nav-text--hide-pc">access</span>
							<span class="header-nav-text-ja 
								<?php
								if ( ! is_front_page() ) {
									echo ' header-nav-text--black';}
								?>
								">アクセス</span>
						</a>
					</li>
					<li class="header-nav-item header-nav-item--contact">
						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="header-nav-link">
							<span class="header-nav-text-en header-nav-text--hide-pc">contact</span>
							<span class="header-nav-text-ja">お問い合わせ</span>
						</a>
					</li>
				</ul>
			</nav>
		</dialog>
		<!-- /header menu -->
		</div>
	</header>
	<!-- /header -->
