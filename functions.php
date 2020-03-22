<?php
if ( !defined( 'ABSPATH' ) ) {
exit;
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_script( 'jquery-heightLine', get_stylesheet_directory_uri() . '/js/jquery.heightLine.js', array( 'jquery' ) );
}

if (locate_template('/st-child-kanri.php') !== '') {
require_once locate_template('/st-child-kanri.php');
}

if ( !function_exists( 'load_stylesheet_child2' ) ) {
	function register_stylesheet_child2() {
		wp_register_style( 'single_child2', get_stylesheet_directory_uri() . '/st-child-kanricss.php', array(), null, 'all' );
	}

	function load_stylesheet_child2() {
		register_stylesheet_child2();
		wp_enqueue_style( 'single_child2' );
	}
}
add_action( 'wp_enqueue_scripts', 'load_stylesheet_child2' );

function st_child_admin_script(){
	wp_enqueue_script( 'st-admin-script', get_stylesheet_directory_uri() . '/st-child-admin-script.js', array( 'jquery' ) );
}
add_action( 'admin_enqueue_scripts', 'st_child_admin_script' );

function stFirstpost(){
    global $wp_query;
    return ($wp_query->current_post === 0);
}

//サムネイルサイズの追加
add_image_size( 'st_thumb_card', 400, 300, true );

function st_cards_js_function() {
echo <<< EOM
<script>
	jQuery(function() {
		jQuery(window).load(function(){
			jQuery('.heightLine').heightLine({
				minWidth:600
			});
		});
	});
</script>
EOM;
}
add_action( 'wp_footer', 'st_cards_js_function' );

//PickUp
if ( !function_exists( 'st_rumdom_picktitile' ) ) {
	function st_rumdom_picktitile() {
		if ( trim($GLOBALS['st_child_jet_data9']) !== '' ) {
			echo '<span class="st-pick">PickUp</span>';
		} else {
			echo '';
		}
	}
}

/////////////////////////
//テーマ管理設定自動設定
/////////////////////////

if( trim($GLOBALS['st_child_jet_data5']) === '' ): /*有効化するかどうか*/
	//←先頭にコメントアウトをつけることで個別に設定を解除できます
	add_filter( 'option_st-data201', function () { return 'yes'; } ); // サイドバーのカテゴーリンクに簡易デザイン適応
	add_filter( 'option_st-data52', function () { return 'yes'; } );  // ヘッダーを分割しない
	add_filter( 'option_st-data105', function () { return 'yes'; } ); // ヘッダーエリアをセンタリング
	add_filter( 'option_st-data73', function () { return '60'; } );   // 抜粋の文字数※デフォルトは100（ブログカード風ショートコード含む）
	add_filter( 'option_st-data320', function () { return ''; } );   // トップページ及びアーカイブの記事一覧をカードデザインにする（EX）
	if( trim($GLOBALS['st_child_jet_data4']) === '' ): /*有効化するかどうか*/
		//←先頭にコメントアウトをつけることで個別に設定を解除できます
		add_filter( 'option_st-data322', function () { return ''; } );   // 投稿記事下の関連記事一覧をカードデザインにする（EX）
	endif;
endif;

if( trim($GLOBALS['st_child_jet_data8']) === '' ): /*有効化するかどうか*/
	/////////////////////////
	//カスタマイザー設定
	/////////////////////////
	add_filter( 'theme_mod_st_header100', function () { return 'yes'; } ); // ヘッダー背景の横幅を100%にする
	add_filter( 'theme_mod_st_footer100', function () { return 'yes'; } ); // フッターの背景色を100%にする
	add_filter( 'theme_mod_st_menu100', function () { return 'yes'; } );   // PCメニュー100%
endif;
//自動設定ここまで