<?php
/**
 * The template for displaying the breadcrumb
 *
 * @package MORISITA-Corporation
 */

?>

<?php if ( function_exists( 'bcn_display' ) ) : ?>
<nav class="c-breadcrumb" aria-label="パンくずリスト">
	<div class="l-container">
		<ol class="c-breadcrumb-list">
			<?php bcn_display(); ?>
		</ol>
	</div>
</nav>
<?php endif; ?>