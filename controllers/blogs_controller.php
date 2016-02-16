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

		case 'add':
			$controller->add();
			break;

		case 'create':
			if (!empty($post['title']) && !empty($post['body'])) {
				$controller->create($_POST);
			} else {
				$controller->add();
			}
			break;

		case 'edit':
			$controller->edit($id);
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
			// 詳細ページの情報を取得
			$this->viewOptions = $this->blog->show($id);

			// コンストラクタで初期値が「index」になっているので、「show」に設定
			$this->action = 'show';

			$this->display();
		}

		/* 登録ページを表示 */
		public function add(){
			$this->action = 'add';
			$this->display();
		}

		/* 登録処理 */
		public function create($post){
			$this->blog->create($post);

			header('Location: index');
		}

		/* 編集ページを表示 */
		public function edit($id){
			// 編集ページの情報を取得
			$this->viewOptions = $this->blog->edit($id);

			$this->action = 'edit';
			$this->display();
		}

		/* ビューを表示 */
		private function display(){
			require('views/layout/application.php');
		}
	}
?>
