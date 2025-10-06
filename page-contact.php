<?php
/**
 * The template for displaying the contact page
 *
 * @package MORISITA-Corporation
 */

get_header();
?>


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
			<span class="c-sub-kv-heading-en">contact</span>
			<h1 class="c-sub-kv-heading-ja">お問い合わせ</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->
	<?php get_template_part( 'template/breadcrumb' ); ?>
	<!-- /breadcrumb -->

	<!-- contact-contents -->
	<div class="contact-contents l-container-s">
		<p class="contact-description">
			ご質問やご相談があれば、以下フォームよりお問い合わせください。
		</p>
		<?php the_content(); ?>
	</div>

	<!-- /message-contents -->
	<?php
		endwhile;
	endif;
	?>
</main>
<!-- /main -->

<?php get_footer(); ?>