<?php
	session_start();
	$name = $_SESSION["name"];
	$name_phonetic = $_SESSION["name_phonetic"];
	$tel = $_SESSION["tel"];
	
?>


<!DOCTYPE html>
<html>
<head>
<title>入力フォーム</title>

</head>
<body>
<form method="post" action="check.php">

 <tr>
      <td>名前</td>
      <td><input type="text" name="name"></td>	<br>
      <td>名前カナ</td>	
      <td><input type="text" name="name_phonetic"></td>	<br>
      <td>電話番号</td>
      <td><input type="text" name="tel"></td>	<br>
      <input type="submit" name="send" value="確認する">
 </tr>
</form>
</body>
</html>

