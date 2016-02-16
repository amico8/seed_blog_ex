<?php
	/**
	* モデルのクラス
	*/
	class Blog {
		// プロパティ
		private $dbconnect = '';

		// コンストラクタ
		public function __construct(){
			// DB接続
			require('dbconnect.php');

			$this->dbconnect = $db;
		}

		/* 一覧ページを表示 */
		public function index() {
			$sql = 'SELECT * FROM `blogs` WHERE `delete_flag` = 0;';
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));

			// 戻り値
			$rtn = array();
			while ($result = mysqli_fetch_assoc($results)) {
				$rtn[] = $result;
			}
			return $rtn;
		}

		/* 詳細情報を表示 */
		public function show($id) {
			echo 'モデルのshowメソッドを呼び出しました！';
		}
	}
?>