<?php
	session_start();
	$id = $_SESSION["id"];
	
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

	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}

	
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
  <th scope="col">ID</th> 
  <th scope="col">名前</th> 
  <th scope="col">名前カナ</th> 
  <th scope="col">電話番号</th> 
 </tr> 	
 <?php 
foreach ($rows as $row) {
	
 ?> 
 <tr> 
 	
 
  <td><?php print(htmlspecialchars($row['id'])); ?> </td> 
  <td><?php print(htmlspecialchars($row['name'])); ?> </td> 
  <td><?php print(htmlspecialchars($row['name_phonetic'])); ?> </td>
  <td><?php print(htmlspecialchars($row['tel'])); ?> </td> 
  <td>
		<form action="del_validate.php" method="post">
		<input type="submit" value="削除する">
		<input type="hidden" name="id" value="<?=$row['id']?>">
		</form>
	</td>
  <td>
		<form action="edit.php" method="post">
		<input type="submit" value="編集する">
		<input type="hidden" name="id" value="<?=$row['id']?>">
		</form>
 </td>
 </tr>
 
 
 <?php 
 } 
 ?> 
</table>

</body>
</html>