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

/**
 * 投稿編集画面に関連記事IDの入力Formを追加
 */
function related_post_ids_meta_box() {
	add_meta_box(
		'related-post-ids',
		'関連記事ID(カンマ区切りで入力)',
		'related_post_ids_meta_box_callback',
		'post',
		'side'
	);
}
add_action( 'add_meta_boxes', 'related_post_ids_meta_box' );
function related_post_ids_meta_box_callback( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'related_post_ids_nonce', 'related_post_ids_nonce' );
	$value = get_post_meta( $post->ID, '_related_post_ids', true );
	echo '<input style="width:100%" id="related_post_ids" name="related_post_ids" value="'. esc_attr( $value ) . '" placeholder="1,3,88">';
}
/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_related_post_ids_meta_box_data( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['related_post_ids_nonce'] ) ) {
		return;
	}
	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['related_post_ids_nonce'], 'related_post_ids_nonce' ) ) {
		return;
	}
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
		}
	}
	else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	// Make sure that it is set.
	if ( ! isset( $_POST['related_post_ids'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['related_post_ids'] );

	// 空白除去
	$my_data  = preg_replace("/( |　)/", "", $my_data );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_related_post_ids', $my_data );
}
add_action( 'save_post', 'save_related_post_ids_meta_box_data' );