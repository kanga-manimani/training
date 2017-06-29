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

	$keyword = $_POST["keyword"];
	mysqli_real_escape_string($keyword);

	$sql = "SELECT * FROM register WHERE name LIKE '%$keyword%' ";
	$result = mysqli_query($link, $sql);

	echo $_POST["del_flag"];
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
<title>検索結果</title>
</head>
<body>
<h2>検索結果</h2>
<tr>
<table>
 <tr> 
  <th scope="col">ID</th> 
  <th scope="col">名前</th> 
  <th scope="col">名前カナ</th> 
  <th scope="col">電話番号</th> 
 </tr> 	
 <?php 
 while($table = mysqli_fetch_assoc($result)) { 
 ?> 
 <tr> 
  <td><?php print(htmlspecialchars($table['id'])); ?> </td> 
  <td><?php print(htmlspecialchars($table['name'])); ?> </td> 
  <td><?php print(htmlspecialchars($table['name_phonetic'])); ?> </td>
  <td><?php print(htmlspecialchars($table['tel'])); ?> </td> 
 </tr>
 <?php 
 } 
 ?> 
</table>
</tr>
<table>
</table>
</form>
</body>
</html>