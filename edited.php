<?php
	session_start();
	$name = $_POST["name"];
	$name_phonetic = $_POST["name_phonetic"];
	$tel = $_POST["tel"];
	$id = $_POST["id"];

	// foreach($_POST as $value){
	//  	echo $value;
	// }
	

	$link = mysqli_connect('localhost', 'root', '');
	if (!$link) {
	   die('接続できませんでした: ' . mysqli_error());
	}

	$db_selected = mysqli_select_db($link, 'input');
	if (!$db_selected) {
		die('SELECTクエリーが失敗しました。'.mysql_error());
	}
	mysqli_set_charset($link, 'utf8');

	if(empty($_POST["name"]) &&  empty($_POST["name_phonetic"]) && empty($_POST["tel"])) {
		die("変更箇所が入力されていません");
	}else{
		$stmt = mysqli_prepare($link, "UPDATE register SET name=?, name_phonetic=?, tel=? WHERE id=?");
		mysqli_stmt_bind_param($stmt, "sssi", $name, $name_phonetic, $tel, $id);
	 	mysqli_execute($stmt);
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
	<tr>
      <td>名前：</td>
      <td><?php echo $name; ?></td>	<br>
      <td>名前カナ：</td>	
      <td><?php echo $name_phonetic; ?></td>	<br>
      <td>電話番号：</td>
      <td><?php echo $tel; ?></td>	<br>
      <td>以上の内容で登録しました</td>
 </tr>
 </body>
 </html>