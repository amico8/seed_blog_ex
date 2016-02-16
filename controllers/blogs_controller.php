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

		case 'show':
			$controller->show($id);
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
		private $viewOptions = '';

		// コンストラクタ
		public function __construct(){
			$this->blog = new Blog();
			$this->resource = 'blogs';
			$this->action = 'index';
			$this->viewOptions = array();
		}

		/* 一覧ページを表示 */
		public function index(){
			// 一覧ページの情報を取得
			$this->viewOptions = $this->blog->index();

			// foreach ($this->viewOptions as $viewOption) {
			// 	echo $viewOption['id'];
			// 	echo $viewOption['title'];
			// 	echo $viewOption['modified'];
			// }

			$this->display();
		}

		/* 詳細ページを表示 */
		public function show($id){
			$this->blog->show($id);
			// コンストラクタで初期値が「index」になっているので、「show」に設定
			$this->action = 'show';

			$this->display();
		}

		/* ビューを表示 */
		private function display(){
			require('views/layout/application.php');
		}
	}
?>
