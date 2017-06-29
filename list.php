<?php
	session_start();

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
<title>リスト画面</title>
</head>
<body>
<form method="post" action="search.php">
<tr>
  <td><input type="text" name="keyword"></td>
  <input type="submit" name="search" value="検索する">
</tr>
<table>
 <tr> 
<!--   <th scope="col">ボタン</th> -->
  <th scope="col">ID</th> 
  <th scope="col">名前</th> 
  <th scope="col">名前カナ</th> 
  <th scope="col">電話番号</th> 
 </tr> 	
 <?php 
 while($table = mysqli_fetch_assoc($result)) { 
 ?> 
 <tr> 
<!--  <td><input type="radio" name="del_flag" value="test"></td> -->
  <td><?php print(htmlspecialchars($table['id'])); ?> </td> 
  <td><?php print(htmlspecialchars($table['name'])); ?> </td> 
  <td><?php print(htmlspecialchars($table['name_phonetic'])); ?> </td>
  <td><?php print(htmlspecialchars($table['tel'])); ?> </td> 
 </tr>
 
 
 <?php 
 } 
 ?> 
</table>
</form>
</body>
</html>