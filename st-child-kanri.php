<?php
if ( !defined( 'ABSPATH' ) ) {
     exit;
}

$st_child_jet_data1 = get_option( 'st-child-jet-data1','' );
$st_child_jet_data2 = get_option( 'st-child-jet-data2','' );
$st_child_jet_data3 = get_option( 'st-child-jet-data3','' );
$st_child_jet_data4 = get_option( 'st-child-jet-data4','' );
$st_child_jet_data5 = get_option( 'st-child-jet-data5','' );
$st_child_jet_data6 = get_option( 'st-child-jet-data6','' );
$st_child_jet_data7 = get_option( 'st-child-jet-data7','' );
$st_child_jet_data8 = get_option( 'st-child-jet-data8','' );
$st_child_jet_data9 = get_option( 'st-child-jet-data9','' );
$st_child_jet_data10 = get_option( 'st-child-jet-data10','' );
$st_child_jet_data11 = get_option( 'st-child-jet-data11','' );
$st_child_jet_data12 = get_option( 'st-child-jet-data12','' );
$st_child_jet_data13 = get_option( 'st-child-jet-data13','' );
$st_child_jet_data14 = get_option( 'st-child-jet-data14','' );
$st_child_jet_data15 = get_option( 'st-child-jet-data15','' );
$st_child_jet_data16 = get_option( 'st-child-jet-data16','' );
$st_child_jet_data17 = get_option( 'st-child-jet-data17','' );
$st_child_jet_data18 = get_option( 'st-child-jet-data18','' );

add_action( 'admin_menu', 'my_admin_child_menu' );

function my_admin_child_menu() {
     add_menu_page(
          __( 'JET管理', 'default' ),
          __( 'JET管理', 'default' ),
          'manage_options',
          'my-custom-child-admin',
          'my_custom_child_admin'
     );

     add_submenu_page(
	  'my-custom-child-admin',
          __( 'JET管理リセット', 'default' ),
          __( 'JET管理リセット', 'default' ),
          'manage_options',
          'my-child-submenu',
          'my_child_submenu'
     );
}

// 基本管理画面
function my_custom_child_admin() {
     ?>
     <div class="wrap">
          <h2 style="margin-bottom:20px">JET（子テーマ）管理画面</h2>
          <form id="my-main-form" method="post" action="">
               <?php wp_nonce_field( 'my-nonce-key', 'my-custom-child-admin' ); ?>

<?php if( $GLOBALS["st_child_jet_data1"] === 'yes' ) :
	$st_child_jet_data2 = '';
	$st_child_jet_data4 = '';
endif;
?>
<div class="st-mokuzi">

<h3 id="header-menu" class="h3tai"><i class="fa fa-bars"></i>基本設定</h3>

               <h4><i class="fa fa-desktop" aria-hidden="true"></i>カードデザイン管理</h4>

               <p>
                    <input type="checkbox" name="st-child-jet-data1" value="yes" <?php if ( $GLOBALS["st_child_jet_data1"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
                    トップ及びアーカイブページの第一投稿を大きくしない（※関連設定はリセットされます）</p>

		<div style="padding-left:20px;">

				<?php if( $GLOBALS["st_child_jet_data1"] === 'yes' ) : ?>
                    <p style="color:#ff0000;">※以下の設定は「画像を大きく表示する場合」のみ有効化されます</p>
				<?php else: ?>
				<?php endif; ?>

               <p>
				<?php if( $GLOBALS["st_child_jet_data1"] === 'yes' ) : ?>
                    <input type="checkbox" name="st-child-jet-data2" value="" disabled="disabled">
				<?php else: ?>
                    <input type="checkbox" name="st-child-jet-data2" value="yes" <?php if ( $GLOBALS["st_child_jet_data2"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
				<?php endif; ?>
                    トップ及びアーカイブページの第一投稿にアミ点を入れる（画質ぼかし）</p>

               <p>
				<?php if( $GLOBALS["st_child_jet_data1"] === 'yes' ) : ?>
                    第一投稿の記事IDを指定（※複数不可）:<input type="number" pattern="^[0-9]+$" name="st-child-jet-data6" value="" placeholder="記事ID" disabled="disabled">
				<?php else: ?>
                   第一投稿の記事IDを指定（※複数不可）: <input type="number" pattern="^[0-9]+$" name="st-child-jet-data6" value="<?php echo esc_attr( $GLOBALS["st_child_jet_data6"] ); ?>" placeholder="記事ID">
				<?php endif; ?>
                    </p>

               <p>
				<?php if( $GLOBALS["st_child_jet_data1"] === 'yes' ) : ?>
                    <input type="checkbox" name="st-child-jet-data3" value="" disabled="disabled">
				<?php else: ?>
                    <input type="checkbox" name="st-child-jet-data3" value="yes" <?php if ( $GLOBALS["st_child_jet_data3"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
				<?php endif; ?>
                    1投稿目をランダム表示（指定優先）</p>

				<?php if ( trim( $GLOBALS["st_child_jet_data3"] ) === '' && trim( $GLOBALS["st_child_jet_data6"] ) === '' ) : ?>
                    <input type="checkbox" name="st-child-jet-data9" value="" disabled="disabled">
				<?php else: ?>
                    <input type="checkbox" name="st-child-jet-data9" value="yes" <?php if ( $GLOBALS["st_child_jet_data9"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
				<?php endif; ?>
			1投稿目の記事ID指定又はランダム表示時に「PickUp」の文字を入れる</p>

				<p>※第一投稿をID指定又はランダムにしている場合は「投稿日」は表示されません<br />※縦横比が横に長い画像は閲覧サイズによって上下に余白が生じる場合がございます</p>
		</div>

				<p>
					<input type="checkbox" name="st-child-jet-data15" value="yes" <?php if ( $GLOBALS["st_child_jet_data15"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事タイトルを省略しない（※カードが長くなる場合あり）</p>

				<p>
					<input type="checkbox" name="st-child-jet-data11" value="yes" <?php if ( $GLOBALS["st_child_jet_data11"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事カード（トップ及びアーカイブのみ）の枠線を追加</p>

				<p>
					<input type="checkbox" name="st-child-jet-data13" value="yes" <?php if ( $GLOBALS["st_child_jet_data13"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事カードに影（シャドウ）を追加</p>

				<p>
					<input type="checkbox" name="st-child-jet-data16" value="yes" <?php if ( $GLOBALS["st_child_jet_data16"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事カード回りの余白を大きくする（5px→10px）</p>

               <p>
                    <input type="checkbox" name="st-child-jet-data10" value="yes" <?php if ( $GLOBALS["st_child_jet_data10"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
				   トップページ及びアーカイブタイトルの下に2色ボーダー追加</p>
               <p>
                    <input type="checkbox" name="st-child-jet-data4" value="yes" <?php if ( $GLOBALS["st_child_jet_data4"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
                    関連記事をカード化しない</p>

				<p>
					<input type="checkbox" name="st-child-jet-data12" value="yes" <?php if ( $GLOBALS["st_child_jet_data12"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					アーカイブ（カテゴリ含む）ページのタイトルとパンクズを非表示にする</p>
			  
				<p>
					<input type="checkbox" name="st-child-jet-data14" value="yes" <?php if ( $GLOBALS["st_child_jet_data14"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事カードのカテゴリを角丸にする</p>

				<p>
					<input type="checkbox" name="st-child-jet-data18" value="yes" <?php if ( $GLOBALS["st_child_jet_data18"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					日付の表示位置を下にする</p>

				<p>
					<input type="checkbox" name="st-child-jet-data17" value="yes" <?php if ( $GLOBALS["st_child_jet_data17"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
					記事一覧のサムネイルをフルサイズにする（β）*</p>
				<p class="komozi">
					* 各カードのサイズは一覧にあるコンテンツの最大の高さに統一されます。フルサイズを使用する場合はアイキャッチ画像のサイズ及び縦横比を統一することをお勧めいたします。</p>
				<p class="komozi">* 画像の遅延読込プラグインを使用していると高さが正常に取得できない可能性があります</p>

		<div class="item-recom" style="margin-bottom:20px;">
			<h4 id="st-item"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#ff0000;"></i>JETの自動設定について</h4>
			<p>
				オリジナル子テーマ「JET」ではデザインを簡単に設定するために親テーマ管理の設定及びカスタマイザーを自動上書きしています。その為、一部の機能は変更できません。「上書きを解除」することで変更可能になりますがデフォルトの設定及びデザインは無効化されます（使用方法によってはレイアウトが崩れる可能性もございます。無効化後は必ず自身で確認をしてください。）
			</p>
               <p>
                    <input type="checkbox" name="st-child-jet-data5" value="yes" <?php if ( $GLOBALS["st_child_jet_data5"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
                    JETによる親テーマ管理設定の上書きを解除する</p>
                    <input type="checkbox" name="st-child-jet-data7" value="yes" <?php if ( $GLOBALS["st_child_jet_data7"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
                    JETによるカスタマイザーのカラーの自動上書きを解除する<br />
                    <input type="checkbox" name="st-child-jet-data8" value="yes" <?php if ( $GLOBALS["st_child_jet_data8"] === 'yes' ) {
                         echo 'checked';
                    } ?>>
                    JETによるカスタマイザーのレイアウト設定の自動上書きを解除する</p>
		</div>

                    <input type="submit" value="<?php echo esc_attr( __( 'save',
                         'default' ) ); ?>" class="button button-primary button-large">
               </p>
</div>


          </form>
</div>

<?php }

// サブ管理画面
function my_child_submenu() {
     ?>

     <div class="wrap">
          <h2>JET（子テーマ）管理リセット画面</h2>
           <form id="my-main-form" method="post" action="">
               <?php wp_nonce_field( 'my-nonce-key', 'my-custom-child-admin' ); ?>
			<p style="color:#ff0000">※「JET管理画面」に不具合が生じた場合、こちらからリセットできます。</p>

               <p>
			<input type="checkbox" name="st-child-jet-data-reset" value="yes" onclick="window.alert('※チェックを入れて保存するとJET管理画面が全てリセットされます');">
                    全てリセットする</p>         

               <p>
                    <input type="submit" value="<?php echo esc_attr( __( 'save',
                         'default' ) ); ?>" class="button button-primary button-large">
               </p>
          </form>
     </div>
<?php }

//データ保存

add_action( 'admin_init', 'my_admin_child_init' );

function my_admin_child_init() {
     if ( isset( $_POST['my-custom-child-admin'] ) && $_POST['my-custom-child-admin'] ) {
          if ( check_admin_referer( 'my-nonce-key', 'my-custom-child-admin' ) ) {
	  if ( isset( $_POST['st-child-jet-data-reset'] ) && $_POST['st-child-jet-data-reset'] === 'yes' ) {
		 //リセット処理
		for( $i = 1; $i <= 18; $i++ ){
			$st_delete_no = 'st-child-jet-data'.$i;
			update_option( $st_delete_no , '' );
		}

	}else{

               if ( isset( $_POST['st-child-jet-data1'] ) && $_POST['st-child-jet-data1'] ) { //画像を大きくしない場合

                    update_option( 'st-child-jet-data1', $_POST['st-child-jet-data1'] );
                    update_option( 'st-child-jet-data2', '' );
                    update_option( 'st-child-jet-data3', '' );
                   	update_option( 'st-child-jet-data6', '' );
                    update_option( 'st-child-jet-data9', '' );

               } else { //画像を大きくする

                    update_option( 'st-child-jet-data1', '' );

               		if ( isset( $_POST['st-child-jet-data2'] ) && $_POST['st-child-jet-data2'] ) {
                   	 	update_option( 'st-child-jet-data2', $_POST['st-child-jet-data2'] );
               		} else {
                   		 update_option( 'st-child-jet-data2', '' );
               		
					}

               		if ( isset( $_POST['st-child-jet-data3'] ) && $_POST['st-child-jet-data3'] ) {
                    	update_option( 'st-child-jet-data3', $_POST['st-child-jet-data3'] );
               		} else {
                    	update_option( 'st-child-jet-data3', '' );
               		}

               		if ( isset( $_POST['st-child-jet-data9'] ) && $_POST['st-child-jet-data9'] ) {
                    	update_option( 'st-child-jet-data9', $_POST['st-child-jet-data9'] );
               		} else {
                    	update_option( 'st-child-jet-data9', '' );
               		}

               		if ( isset( $_POST['st-child-jet-data6'] ) && $_POST['st-child-jet-data6'] ) {
                    	update_option( 'st-child-jet-data6', $_POST['st-child-jet-data6'] );
               		} else {
                    	update_option( 'st-child-jet-data6', '' );
               		}

               }

               if ( isset( $_POST['st-child-jet-data4'] ) && $_POST['st-child-jet-data4'] ) {
                    update_option( 'st-child-jet-data4', $_POST['st-child-jet-data4'] );
               } else {
                    update_option( 'st-child-jet-data4', '' );
               }

               if ( isset( $_POST['st-child-jet-data5'] ) && $_POST['st-child-jet-data5'] ) {
                    update_option( 'st-child-jet-data5', $_POST['st-child-jet-data5'] );
               } else {
                    update_option( 'st-child-jet-data5', '' );
               }

               if ( isset( $_POST['st-child-jet-data7'] ) && $_POST['st-child-jet-data7'] ) {
                    update_option( 'st-child-jet-data7', $_POST['st-child-jet-data7'] );
               } else {
                    update_option( 'st-child-jet-data7', '' );
               }

               if ( isset( $_POST['st-child-jet-data8'] ) && $_POST['st-child-jet-data8'] ) {
                    update_option( 'st-child-jet-data8', $_POST['st-child-jet-data8'] );
               } else {
                    update_option( 'st-child-jet-data8', '' );
               }

               if ( isset( $_POST['st-child-jet-data10'] ) && $_POST['st-child-jet-data10'] ) {
                    update_option( 'st-child-jet-data10', $_POST['st-child-jet-data10'] );
               } else {
                    update_option( 'st-child-jet-data10', '' );
               }

               if ( isset( $_POST['st-child-jet-data11'] ) && $_POST['st-child-jet-data11'] ) {
                    update_option( 'st-child-jet-data11', $_POST['st-child-jet-data11'] );
               } else {
                    update_option( 'st-child-jet-data11', '' );
               }

               if ( isset( $_POST['st-child-jet-data12'] ) && $_POST['st-child-jet-data12'] ) {
                    update_option( 'st-child-jet-data12', $_POST['st-child-jet-data12'] );
               } else {
                    update_option( 'st-child-jet-data12', '' );
               }

               if ( isset( $_POST['st-child-jet-data13'] ) && $_POST['st-child-jet-data13'] ) {
                    update_option( 'st-child-jet-data13', $_POST['st-child-jet-data13'] );
               } else {
                    update_option( 'st-child-jet-data13', '' );
               }

               if ( isset( $_POST['st-child-jet-data14'] ) && $_POST['st-child-jet-data14'] ) {
                    update_option( 'st-child-jet-data14', $_POST['st-child-jet-data14'] );
               } else {
                    update_option( 'st-child-jet-data14', '' );
               }

               if ( isset( $_POST['st-child-jet-data15'] ) && $_POST['st-child-jet-data15'] ) {
                    update_option( 'st-child-jet-data15', $_POST['st-child-jet-data15'] );
               } else {
                    update_option( 'st-child-jet-data15', '' );
               }

               if ( isset( $_POST['st-child-jet-data16'] ) && $_POST['st-child-jet-data16'] ) {
                    update_option( 'st-child-jet-data16', $_POST['st-child-jet-data16'] );
               } else {
                    update_option( 'st-child-jet-data16', '' );
               }

               if ( isset( $_POST['st-child-jet-data17'] ) && $_POST['st-child-jet-data17'] ) {
                    update_option( 'st-child-jet-data17', $_POST['st-child-jet-data17'] );
               } else {
                    update_option( 'st-child-jet-data17', '' );
               }

               if ( isset( $_POST['st-child-jet-data18'] ) && $_POST['st-child-jet-data18'] ) {
                    update_option( 'st-child-jet-data18', $_POST['st-child-jet-data18'] );
               } else {
                    update_option( 'st-child-jet-data18', '' );
               }

	  }
	     wp_safe_redirect( menu_page_url( 'my-custom-child-admin', false ) );
          }
     }
}
