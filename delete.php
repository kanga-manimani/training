<?php
	session_start();
	$id = $_POST['id'];

	$link = mysqli_connect('localhost', 'root', '');
	if (!$link) {
	   die('接続できませんでした: ' . mysqli_error());
	}
	
	$db_selected = mysqli_select_db($link, 'input');
	if (!$db_selected) {
		die('SELECTクエリーが失敗しました。'.mysql_error());
	}
	
	mysqli_set_charset($link, 'utf8');

	if(empty($_POST) || !isset($_POST['id'])  || !is_numeric($_POST['id']) ) {
		die('IDエラー');
	}else{
		// プリペアドステートメントを作成
		$stmt =  mysqli_prepare($link, "DELETE FROM register WHERE id=?");
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

	}

	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
<title>完了画面</title>
</head>
<body>
<h1>削除が完了しました</h1>
</body>
</html>