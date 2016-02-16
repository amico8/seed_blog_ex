<?php
	// explode()関数：第2引数の文字列を、第1引数の文字で分割し配列で返す関数。
	$params = explode('/', $_GET['url']);
	// var_dump($_GET);
	// var_dump($params);

	// getパラメータで指定されたリソース名とアクション名を取得
	$resource = $params[0];
	$action = $params[1];
	$id = 0;
	$post = array();

	// idがあった場合はidも取得する
	if (isset($params[2])) {
		$id = $params[2];
	}

	if (isset($_POST) && !empty($_POST)) {
		$post = $_POST;
	}
	// コントローラの呼び出し
	require('controllers/' . $resource . '_controller.php');
?>
