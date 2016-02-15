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
		private $resource = '';
		private $action = '';

		// コンストラクタ
		public function __construct(){
			$this->blog = new Blog();
			$this->resource = 'blogs';
			$this->action = 'index';
		}

		/* 一覧ページを表示 */
		public function index(){
			$this->blog->index();
			$this->display();
		}

		/* ビューを表示 */
		private function display(){
			require('views/layout/application.php');
		}
	}
?>
