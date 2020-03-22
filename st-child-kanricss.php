<?php
header('Content-Type: text/css; charset=utf-8');
include_once(dirname( __FILE__ ) . '/../../../wp-load.php');
?>
@charset "UTF-8";

<?php if(trim($GLOBALS['st_child_jet_data17']) === ''){ // サムネイルをフルサイズにする無効化 ?>
	#st-magazine .kanren .st-top-box:not(.st-fist-post) dt { /* 最初の記事以外は180px */
		height: 180px;
	}

	/* 天地中央で切り抜く */
	#st-magazine .kanren .st-top-box:not(.st-fist-post) dt img {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
	}

	#st-magazine.st-magazine-k .kanren dt img {
		object-fit: cover;
	}

	@media only screen and (max-width: 599px) { /* モバイルは最初の記事も180px */

		#st-magazine .kanren .st-top-box dt {
			height: 180px;
		}

		#st-magazine .kanren .st-top-box dt img {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
		}
	}

	/* ブログカード風マガジン最初の投稿
	----------------------------------------------------*/
	@media only screen and (min-width: 600px) {
		#st-magazine .kanren .st-top-box.st-fist-post dt {
			overflow: hidden;
			width: 100%; /* トリミングしたい枠の幅 */
			height: 350px; /* トリミングしたい枠の高さ */
			position: relative;
		}

		#st-magazine .kanren .st-top-box.st-fist-post dl:last-child {
			padding-bottom:0;
		}

		#st-magazine .kanren .st-top-box.st-fist-post dt img {
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			width: 100%;
			height: auto;
		}

		#st-magazine .kanren .st-fist-post dd {
			width: 100%;
			box-sizing:border-box;
			padding: 0!important;
			position:absolute;
			bottom:0;
			left:0px;
			z-index:999;
		}

		#st-magazine .kanren .st-fist-post dd .st-cards-content {
			padding:0px;
		}
		#st-magazine .kanren .st-fist-post dd .st-cards-content-in {
			background: rgba(255,255,255,0.7);
			padding: 10px 40px 20px;
		}

		#st-magazine .kanren .st-fist-post dd h3 {
			font-size:150%;
			margin-bottom:5px;
			line-height:1.5;
			padding-top:20px;
		}
	}

	@media print, screen and (min-width: 960px) {
		#st-magazine .kanren .st-top-box.st-fist-post dt {
			width: 100%; /* トリミングしたい枠の幅 */
			height: 400px; /* トリミングしたい枠の高さ */
			position: relative;
		}

	}

<?php } else { // サムネイルをフルサイズにする有効化 ?>

	#st-magazine.st-magazine-k .kanren dt img {
		object-fit: cover;
	}

	/* ブログカード風マガジン最初の投稿
	----------------------------------------------------*/
	@media only screen and (min-width: 600px) {
		#st-magazine .kanren .st-top-box.st-fist-post dt {
			overflow: visible;
			width: 100%; /* トリミングしたい枠の幅 */
			position: relative;
		}

		#st-magazine .kanren .st-top-box.st-fist-post dl:last-child {
			padding-bottom:0;
		}

		#st-magazine .kanren .st-top-box.st-fist-post dt img {
			width: 100%;
			height: auto;
		}

		#st-magazine .kanren .st-fist-post dd {
			width: 100%;
			box-sizing:border-box;
			padding: 0!important;
			position:absolute;
			bottom:0;
			left:0px;
			z-index:999;
		}

		#st-magazine .kanren .st-fist-post dd .st-cards-content {
			padding:0px;
		}
		#st-magazine .kanren .st-fist-post dd .st-cards-content-in {
			background: rgba(255,255,255,0.7);
			padding: 10px 40px 20px;
		}

		#st-magazine .kanren .st-fist-post dd h3 {
			font-size:150%;
			margin-bottom:5px;
			line-height:1.5;
			padding-top:20px;
		}
	}

	@media print, screen and (min-width: 960px) {
		#st-magazine .kanren .st-top-box.st-fist-post dt {
			width: 100%; /* トリミングしたい枠の幅 */
			position: relative;
		}

	}

<?php } ?>

<?php if(trim($GLOBALS['st_child_jet_data14']) !== ''){ // 記事カードのカテゴリ角丸 ?>
	#st-magazine .catname {
		border-radius:20px;
		font-size:14px;
		padding:7px 12px;
	}
<?php } ?>

<?php if ( ( is_front_page() && !is_paged() && trim( $GLOBALS["stdata9"] ) === '' &&  trim( $GLOBALS["stdata89"] ) === '' && !is_active_sidebar( 12 ) )
		|| ( is_category() && !is_paged() && !category_description() ) && !is_active_sidebar( 21 ) ) : //カテゴリーにコンテンツの挿入が無い ?>
	/*トップの基本部分*/
	.home main {
		padding-top: 0;
		background-color:transparent!important;
	}
<?php else: ?>
	.home .post {
    	padding: 0 5px;
		margin-bottom:0;
	}
<?php endif; ?>

<?php if(trim($GLOBALS['st_child_jet_data10']) !== ''){ //トップページ及びアーカイブタイトルの下に2色ボーダー追加 ?>
#st-magazine .kanren .st-top-box.st-continuation-post dd h3 {
	position: relative;
	padding-left:0;
	padding-bottom: 10px;
	border-bottom: solid 1px #ccc; /* 薄い方の線 */
	padding-top:10px;
	margin-bottom:15px!important;
}

#st-magazine .kanren .st-top-box.st-continuation-post dd h3::after {
	position: absolute;
	bottom: -1px;
	left: 0;
	z-index: 3;
	content: '';
	width: 30%;
	height: 1px;
	background-color: #212121; /* 濃い方の線 */
}
<?php } ?>

<?php if(trim($GLOBALS['st_child_jet_data11']) !== ''){ // 記事カードに枠線 ?>
	#st-magazine:not(.st-magazine-k) .kanren .st-top-box:not(.st-magazine-infeed) dl {
    	border: 1px solid #ccc;
	}
<?php } ?>

<?php if(trim($GLOBALS['st_child_jet_data12']) !== ''){ // アーカイブ（カテゴリ含む）ページのタイトルとパンクズを非表示にする ?>
	.archive #breadcrumb,
	.archive .post .entry-title:not(.st-css-no) {
		display: none;
	}
<?php } ?>

<?php if(trim($GLOBALS['st_child_jet_data13']) !== ''){ // 記事カードに影（シャドウ）を追加 ?>
	#st-magazine .kanren .st-top-box.st-continuation-post dl,
	#st-magazine .kanren .st-top-box.st-fist-post dl,
	#st-magazine.st-magazine-k .kanren dl {
		box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	}
<?php } ?>

<?php if( trim( $GLOBALS['st_child_jet_data18'] ) !== '' ): // 日付を下に ?>
	#st-magazine .kanren dd {
		padding-bottom:25px!important;
	}
<?php endif; ?>

/*media Queries タブレットサイズ（959px以下）
----------------------------------------------------*/
@media only screen and (max-width: 959px) {


	/*-- ここまで --*/
}

/*media Queries タブレットサイズ（600px以上）
----------------------------------------------------*/
@media only screen and (min-width: 600px) {

	<?php if ( ( is_front_page() && !is_paged() && trim( $GLOBALS["stdata9"] ) === '' &&  trim( $GLOBALS["stdata89"] ) === '' && !is_active_sidebar( 12 ) )
			|| ( is_category() && !is_paged() && !category_description() ) && !is_active_sidebar( 21 ) ) : //カテゴリーにコンテンツの挿入が無い ?>
	<?php else: ?>
		.home .post {
			padding: 0 15px;
			margin-bottom:0;
		}
	<?php endif; ?>

	<?php if(trim($GLOBALS['stdata91']) !== ''){ //サムネイルサイズを大きく ?>
		#st-magazine .kanren dd,
		#st-magazine .kanren.st-cardbox dd {
			padding-left: 20px!important;
		}
	<?php } ?>

	<?php if(trim($GLOBALS['st_child_jet_data16']) !== ''){ // 記事カード回りの余白を大きく ?>
		#st-magazine .kanren .st-top-box {
			padding: 10px!important;
		}
		#st-magazine .kanren .st-fist-post {
			padding: 0 10px 10px!important;
		}
	<?php } ?>

	/*-- ここまで --*/
}

/*media Queries PCサイズ（960px以上）
----------------------------------------------------*/
@media only screen and (min-width: 960px) {

<?php if ( ( is_front_page() && !is_paged() && trim( $GLOBALS["stdata9"] ) === '' &&  trim( $GLOBALS["stdata89"] ) === '' && !is_active_sidebar( 12 ) )
		|| ( is_category() && !is_paged() && !category_description() ) && !is_active_sidebar( 21 ) ) : //カテゴリーにコンテンツの挿入が無い ?>
	<?php else: ?>
		.home .post {
    		padding: 0 5px;
			margin-bottom:0;
		}
	<?php endif; ?>

	<?php if ( ( trim ( $GLOBALS['stdata37']) === '' || trim ( $GLOBALS['stdata54']) === ''  ) && !is_active_sidebar( 12 ) ): //おすすめトップ記事上部表示にチェックがなく上部ウィジェットもない場合 ?>
		.home main {
    			padding-top: 0;
		}
	<?php endif; ?>

	<?php if(trim($GLOBALS['st_child_jet_data2']) !== ''){ ?>
		/*画像にアミ点*/
		#st-magazine .kanren .st-fist-post dt .st-c-ami{
			background-image: url("images/amiten.png");
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			height:100%;
			width: 100%;
			z-index:1;
		}
	<?php } ?>

	/*-- ここまで --*/
}