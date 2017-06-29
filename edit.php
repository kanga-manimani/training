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

if (empty($_POST)) {
	echo "<a href='list2.php'>list2.php</a>";
	exit();
}
if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
	die("IDエラー");
}else{
	$stmt =  mysqli_prepare($link, "SELECT * FROM register WHERE id=?");
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $name, $name_phonetic, $tel);
	mysqli_stmt_fetch($stmt);
	

	mysqli_stmt_close($stmt);


}

$_SESSION["id"] = $_POST["id"];
$id = $_SESSION["id"];

mysqli_close($link);


?>

<!DOCTYPE html>
<html>
<head>
<title>編集画面</title>
</head>
<body>
<form method="post" action="edited.php">
<tr>
      <td>名前</td>
      <td><input type="text" name="name" value="<?=htmlspecialchars($name, ENT_QUOTES, 'UTF-8')?>"></td>	<br>
      <td>名前カナ</td>	
      <td><input type="text" name="name_phonetic"  value="<?=htmlspecialchars($name_phonetic, ENT_QUOTES, 'UTF-8')?>"></td>	<br>
      <td>電話番号</td>
      <td><input type="text" name="tel" value="<?=htmlspecialchars($tel, ENT_QUOTES, 'UTF-8')?>""></td>	<br>
      <input type="submit" name="send" value="編集する">
      <input type="hidden" name="id" value="<?= $_POST['id']?>">
 </tr>
</body>
</html>