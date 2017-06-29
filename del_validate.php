<?php
	session_start();
	 $_SESSION["id"] = $id;

	$link = mysqli_connect('localhost', 'root', '');
	if (!$link) {
	   die('接続できませんでした: ' . mysqli_error());
	}

	$db_selected = mysqli_select_db($link, 'input');
	if (!$db_selected) {
		die('SELECTクエリーが失敗しました。'.mysql_error());
	}
	mysqli_set_charset($link, 'utf8');

	$sql = "SELECT id, name, name_phonetic, tel FROM register";
	$result = mysqli_query($link, $sql);
	if (!$result) {
	 	die('SELECTクエリーが失敗しました。'.mysqli_error());
	 } 

	// $arr = mysqli_fetch_all($result); 
	// print_r($arr);

	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
<title>確認画面</title>
</head>
<body>
<td><?php echo $_POST['id']; ?>番のデータを本当に削除しますか？</td>
 <td><input type="submit" name="return" value="戻る" onclick="location.href='./list2.php' ">
 <form action="delete.php" method="post">
		<input type="submit" value="削除する">
		<input type="hidden" name="id" value="<?=$_POST['id']?>"></form></td>
</body>
</html>