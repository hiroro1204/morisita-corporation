<?php
/**
 * The template for displaying the privacy policy page
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
			<span class="c-sub-kv-heading-en">privacy policy</span>
			<h1 class="c-sub-kv-heading-ja">プライバシーポリシー</h1>
		</div>
	</div>
	<!-- /sub-kv -->

	<!-- breadcrumb -->

	<?php get_template_part( 'template/breadcrumb' ); ?>

	<!-- /breadcrumb -->

	<!-- privacy-contents -->
	<section class="privacy-contents u-ptb l-container-s">
		<?php the_content(); ?>
	</section>

	<!-- /privacy-contents -->
</main>
<!-- /main -->

<?php get_footer(); ?>
