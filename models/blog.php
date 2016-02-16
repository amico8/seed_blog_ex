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
			$sql = 'SELECT * FROM `blogs` WHERE `delete_flag` = 0 and `id` =' . $id;
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));

			return mysqli_fetch_assoc($results);
		}

		/* 登録処理 */
		public function create($post) {
			$sql = sprintf('INSERT INTO `blogs`(`title`, `body`, `delete_flag`, `created`) VALUES ("%s","%s",0,now())',
				mysqli_real_escape_string($this->dbconnect, $post['title']),
				mysqli_real_escape_string($this->dbconnect, $post['body'])
			);

			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
		}

		/* 編集情報を表示 */
		public function edit($id) {
			$sql = 'SELECT * FROM `blogs` WHERE `delete_flag` = 0 and `id` =' . $id;
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));

			return mysqli_fetch_assoc($results);
		}

		/* 更新処理 */
		public function update($post) {
			$sql = sprintf('UPDATE `blogs` SET `title`="%s",`body`="%s" WHERE `id` = %d',
				mysqli_real_escape_string($this->dbconnect, $post['title']),
				mysqli_real_escape_string($this->dbconnect, $post['body']),
				$post['id']
			);

			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
		}

		/* 削除処理 */
		public function delete($id) {
			$sql = 'UPDATE `blogs` SET `delete_flag`= 1 WHERE `id` =' . $id;
			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
		}
	}
?>