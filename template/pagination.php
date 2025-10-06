<?php
/**
 * The template for displaying the pagination
 *
 * @package MORISITA-Corporation
 */

?>

<?php
// グローバルクエリを取得.
global $wp_query;

// 引数で渡されたクエリがあればそれを使用、なければグローバルクエリを使用.
$the_query = isset( $args['query'] ) ? $args['query'] : $wp_query;

if ( $the_query->max_num_pages > 1 ) :
	echo paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ページネーションの出力.
		array(
			'total'     => $the_query->max_num_pages,
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'prev_text' => '<span aria-label="前のページ"><span class="c-triangle c-triangle--black c-triangle--rotate-180" aria-hidden="true"></span></span>',
			'next_text' => '<span aria-label="次のページ"><span class="c-triangle c-triangle--black" aria-hidden="true"></span></span>',
			'mid_size'  => 1, // 現在ページの前後に表示するページ数.
			'end_size'  => 1, // 先頭・末尾に表示するページ数.
		)
	);
endif;