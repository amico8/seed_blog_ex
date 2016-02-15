<?php

	// モデルクラスのファイルを読み込む
   	require('models/blog.php');

	// コントローラのクラスをインスタンス化
	$controller = new BlogsController();

	// アクション名によって呼び出すメソッドを変える
	switch ($action) {
		case 'index':
			$controller->index();
			break;

		default:
			# code...
			break;
	}

	/**
	* コントローラのクラス
	*/
	class BlogsController {
		// プロパティ
		private $blog = '';

		// コンストラクタ
		function __construct(){
			$this->blog = new Blog();
		}

		/* 一覧ページを表示 */
		function index(){
			$this->blog->index();
			require('views/blogs/index.php');
		}
	}
?>
