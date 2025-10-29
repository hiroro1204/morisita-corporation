<?php
/**
 * MORISITA-Corporation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MORISITA-Corporation
 */

/**
 * Google Fonts を読み込む
 */
function theme_enqueue_google_fonts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Montserrat.
	wp_enqueue_style(
		'google-fonts-montserrat',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap',
		array(),
		$theme_version
	);

	// Play.
	wp_enqueue_style(
		'google-fonts-play',
		'https://fonts.googleapis.com/css2?family=Play:wght@400&display=swap',
		array(),
		$theme_version
	);

	// Zen Kaku Gothic New.
	wp_enqueue_style(
		'google-fonts-zen',
		'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500;700&display=swap',
		array(),
		$theme_version
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_google_fonts' );


/**
 * メインCSS・JSを読み込む
 */
function theme_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'theme-main-style',
		get_template_directory_uri() . '/css/style.css',
		array( 'google-fonts-montserrat', 'google-fonts-play', 'google-fonts-zen' ),
		$theme_version
	);

	wp_enqueue_script(
		'theme-main-script',
		get_template_directory_uri() . '/js/main.js',
		array( 'splide' ), // Splideに依存（ES6モジュールのためjQueryは不要）.
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Splide のライブラリを読み込む
 */
function theme_enqueue_splide() {
	wp_enqueue_style(
		'splide-core',
		get_template_directory_uri() . '/css/library/splide-core.min.css',
		array(),
		'4.1.2'
	);

	wp_enqueue_script(
		'splide',
		get_template_directory_uri() . '/js/library/splide.min.js',
		array(),
		'4.1.2',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_splide' );

/**
 * ES6 モジュール用の属性を追加
 *
 * @param string $tag    スクリプトタグのHTML.
 * @param string $handle スクリプトのハンドル名.
 * @param string $src    スクリプトのURL.
 * @return string        修正されたスクリプトタグ.
 */
function add_type_module_attribute( $tag, $handle, $src ) {
	if ( 'theme-main-script' === $handle ) {
		// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript -- スクリプトタグの修正のため直接出力が必要.
		return '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_type_module_attribute', 10, 3 );


/**
 * エディターCSSを読み込む
 */
function theme_enqueue_editor_css() {
	$post_id = get_the_ID();
	if ( ! $post_id ) {
		wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/css/editor-style.css', array(), '1.0.0' );
		return;
	}

	$slug = get_post_field( 'post_name', $post_id );

	// privacyページとbusinessページの場合は専用CSSのみ読み込み.
	if ( 'privacy' === $slug ) {
		wp_enqueue_style( 'theme-editor-privacy', get_template_directory_uri() . '/css/editor-privacy-style.css', array(), '1.0.0' );
	} elseif ( 'business' === get_post_type( $post_id ) ) {
		wp_enqueue_style( 'theme-editor-business', get_template_directory_uri() . '/css/editor-business-style.css', array(), '1.0.0' );
	} else {
		// その他のページは基本のエディターCSSを読み込み.
		wp_enqueue_style( 'theme-editor', get_template_directory_uri() . '/css/editor-style.css', array(), '1.0.0' );
	}
}
add_action( 'enqueue_block_editor_assets', 'theme_enqueue_editor_css' );

/**
 * アイキャッチ表示
 */
add_theme_support( 'post-thumbnails' );

/**
 * コンタクトフォーム7の時には整形機能を無効化
 */
function disable_contact_form7_formatting() {
	add_filter( 'wpcf7_autop_or_not', '__return_false' );
}
add_action( 'template_redirect', 'disable_contact_form7_formatting' );


/**
 * Contact Form 7のフォーム内でプライバシーポリシーのURLを動的に置換
 *
 * @param string $content フォームのHTMLコンテンツ.
 * @return string 置換後のHTMLコンテンツ.
 */
function replace_privacy_url_in_contact_form( $content ) {
	$privacy_url = esc_url( home_url( '/privacy' ) );
	$content     = str_replace( '{{PRIVACY_URL}}', $privacy_url, $content );
	return $content;
}
add_filter( 'wpcf7_form_elements', 'replace_privacy_url_in_contact_form' );

/**
 * AAccess個別投稿をaccessのアーカイブページへリダイレクト
 */
function redirect_access_single_to_archive() {
	if ( is_admin() || is_preview() ) {
		return;
	}

	// accessの個別投稿をアーカイブページにリダイレクト.
	if ( is_singular( 'access' ) ) {
		$archive_url = get_post_type_archive_link( 'access' );
		if ( $archive_url ) {
			wp_safe_redirect( $archive_url, 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'redirect_access_single_to_archive' );


/**
 * アーカイブページへのリンクを投稿一覧ビューとサブメニューに追加（access, product両対応）
 *
 * @param array  $views 投稿一覧ページのビュー.
 * @param string $post_type 投稿タイプ.
 * @return array 修正されたビュー.
 */
function add_custom_post_type_archive_to_admin( $views = null, $post_type = null ) {
	// $post_typeが渡されていない場合は、現在の画面から取得
	if ( ! $post_type ) {
		$screen = get_current_screen();
		if ( isset( $screen->post_type ) ) {
			$post_type = $screen->post_type;
		}
	}

	// 対象CPTのみ.
	if ( ! in_array( $post_type, array( 'access', 'product' ), true ) ) {
		return $views;
	}

	$url = get_post_type_archive_link( $post_type );

	// 投稿一覧ビューへの追加.
	if ( is_array( $views ) ) {
		if ( $url ) {
			if ( 'access' === $post_type ) {
				$views['view_archive'] = '<a href="' . esc_url( $url ) . '" target="_blank">アクセスページを表示</a>';
			} elseif ( 'product' === $post_type ) {
				$views['view_archive'] = '<a href="' . esc_url( $url ) . '" target="_blank">製品紹介ページを表示</a>';
			}
		}
		return $views;
	}

	// サブメニューへの追加.
	add_submenu_page(
		'edit.php?post_type=' . $post_type,   // 親メニュー（CPTの一覧）.
		( 'access' === $post_type ? 'アクセスページを表示' : '製品紹介ページを表示' ), // ページタイトル.
		( 'access' === $post_type ? 'アクセスページを表示' : '製品紹介ページを表示' ), // メニュータイトル.
		'edit_posts',                  // 権限.
		'view-' . $post_type . '-archive',         // スラッグ.
		function () use ( $url, $post_type ) {
			// コールバック：JavaScriptでリダイレクト.
			if ( $url ) {
				?>
<script>
window.location.href = '<?php echo esc_js( $url ); ?>';
</script>
<noscript>
	<p><a
			href="<?php echo esc_url( $url ); ?>"><?php echo ( 'access' === $post_type ) ? 'アクセスページを表示' : '製品紹介ページを表示'; ?></a>
	</p>
</noscript>
				<?php
			} else {
				wp_die( 'アーカイブURLが見つかりません。has_archive が有効か確認してください。' );
			}
		}
	);
}

// 投稿一覧ビュー用フィルター（access, product両方に対応）.
add_filter(
	'views_edit-access-info',
	function ( $views ) {
		return add_custom_post_type_archive_to_admin( $views, 'access' );
	}
);
add_filter(
	'views_edit-product',
	function ( $views ) {
		return add_custom_post_type_archive_to_admin( $views, 'product' );
	}
);

// サブメニュー用アクション（access, product両方に対応）.
add_action(
	'admin_menu',
	function () {
		add_custom_post_type_archive_to_admin( null, 'access' );
		add_custom_post_type_archive_to_admin( null, 'product' );
	}
);


/**
 * コンテンツエディターを非表示
 */
add_action(
	'init',
	function () {
		// 固定ページ「会社概要」にはエディターを無効化.
		add_filter(
			'use_block_editor_for_post',
			function ( $use_block_editor, $post ) {
				if ( 'page' === $post->post_type && 'company' === $post->post_name ) {
					remove_post_type_support( 'page', 'editor' );
					return false;
				}
				return $use_block_editor;
			},
			10,
			2
		);

		// カスタム投稿タイプ「access-info」「product」は全てエディターを無効化.
		remove_post_type_support( 'access', 'editor' );
		remove_post_type_support( 'product', 'editor' );
	}
);

/**
 * SEO SIMPLE PACK の description を投稿タイプごとに切り替え.
 *
 * @param string $description 説明文.
 * @return string 説明文.
 */
function morisita_custom_ssp_output_description( $description ) {

	// access アーカイブ.
	if ( is_post_type_archive( 'access' ) ) {
		$description = '森下株式会社へのアクセス方法をご案内します。所在地や交通手段についてご確認いただけます。';
	}

	// product アーカイブ.
	if ( is_post_type_archive( 'product' ) ) {
		$description = '森下株式会社の製品ラインナップをご紹介します。多様なニーズに応える高品質な特殊ボルトナットをご覧ください。';
	}

	return $description;
}
add_filter( 'ssp_output_description', 'morisita_custom_ssp_output_description' );


/**
 * セキュリティ対策
 * 参考記事：https://baigie.me/officialblog/2020/01/28/wordpress-security/
 */
remove_action( 'wp_head', 'wp_generator' ); // WordPressのバージョン.
remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // 短縮URLのlink.
remove_action( 'wp_head', 'wlwmanifest_link' ); // ブログエディターのマニフェストファイル.
remove_action( 'wp_head', 'rsd_link' ); // 外部から編集するためのAPI.
remove_action( 'wp_head', 'feed_links_extra', 3 ); // フィードへのリンク.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // 絵文字に関するJavaScript.
remove_action( 'wp_head', 'rel_canonical' ); // カノニカル.
remove_action( 'wp_print_styles', 'print_emoji_styles' ); // 絵文字に関するCSS.
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); // 絵文字に関するJavaScript.
remove_action( 'admin_print_styles', 'print_emoji_styles' ); // 絵文字に関するCSS.

/**
 * 投稿がない年別アーカイブでも404にしない
 */
add_action(
	'pre_handle_404',
	function ( $preempt, $wp_query ) {
		if ( $wp_query->is_year() && ! $wp_query->have_posts() ) {
			return true; // 404を防ぐ
		}
		return $preempt;
	},
	10,
	2
);
