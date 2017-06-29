<?php
	session_start();
    $name = $_SESSION["name"];
	$name_phonetic = $_SESSION["name_phonetic"];
	$tel = $_SESSION["tel"];
    

	//mysql(最初のAPI)**5.x以降非推奨
	// $link = mysql_connect('localhost', 'root', '');
	// if (!$link) {
	//    die('接続できませんでした: ' . mysql_error());
	// }
	// $db_selected = mysql_select_db('input', $link);
	// if (!$db_selected) {
    //   die('SELECTクエリーが失敗しました。'.mysql_error());
	// }

	$link = mysqli_connect('localhost', 'root', '');
	if (!$link) {
	   die('接続できませんでした: ' . mysqli_error());
	}

	$db_selected = mysqli_select_db($link, 'input');
	if (!$db_selected) {
		die('SELECTクエリーが失敗しました。'.mysql_error());
	}

	//忘れるとDB内で文字化けが起こる！
	// mysql_set_charset('utf8');
	mysqli_set_charset($link, 'utf8');
	
	// $result = mysql_query('SELECT id,name,name_phonetic,tel FROM register');
	// if(!$result){
	// 	die('SELECTクエリーが失敗しました。'.mysql_error());
	// }

	// $sql = "INSERT INTO register(name, name_phonetic, tel) VALUES ('$name', '$name_phonetic', '$tel')";
 //    $result_flag = mysql_query($sql);
	// if (!$result_flag) {
	//     die('INSERTクエリーが失敗しました。'.mysql_error());
	// }	

	$sql = "INSERT INTO register(name, name_phonetic, tel) VALUES ('$name', '$name_phonetic', '$tel')";
    $result_flag = mysqli_query($link, $sql);
	if (!$result_flag) {
	     die('INSERTクエリーが失敗しました。'.mysqli_error());
	 }	
	
	mysqli_close($link);
	 
	

?>


<!DOCTYPE html>
<html>
<head>
<title>登録完了画面</title>

</head>
<body>
<h1>登録が完了しました。</h1>
<!--  <tr>
      <td>名前：</td>
      <td><?php echo $name; ?></td>	<br>
      <td>名前カナ：</td>	
      <td><?php echo $name_phonetic; ?></td>	<br>
      <td>電話番号：</td>
      <td><?php echo $tel; ?></td>	<br>
 </tr> -->
</body>
</html>