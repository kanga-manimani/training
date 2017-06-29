<?php
	session_start();
    $_SESSION["name"] = $name;
    $_SESSION["name_phonetic"] = $name_phonetic;
    $_SESSION["tel"] = $tel;

	$error_message = array(); 
	
	if (isset($_POST["send"])) {
	

		if( empty($_POST["name"])) {
			$error_message[0] =  "名前は必ず入力してください";	
		}else{
			$name = htmlspecialchars( $_POST["name"], ENT_QUOTES, 'UTF-8');
		
		}
		if( empty($_POST["name_phonetic"])) {
			$error_message[1] = "名前カナは必ず入力してください";
		}elseif (!(preg_match('/^([ァ-ヾ])+$/mu', $_POST["name_phonetic"]))) {
			$error_message[2] = "名前カナはカタカナで入力してください";
		}else{
			$name_phonetic = htmlspecialchars( $_POST["name_phonetic"], ENT_QUOTES, 'UTF-8');
		}
		if( empty($_POST["tel"])) {
			$error_message[3]= "電話番号は必ず入力してください";
		}elseif( !is_numeric($_POST["tel"])) {
			$error_message[4] = "電話番号は数字で入力してください";
		}else{
			$tel = htmlspecialchars( $_POST["tel"], ENT_QUOTES, 'UTF-8');
		}

		
	}
	//ここで定義しなおすと$_SESSIONを受け渡すことができる。どうしてかは不明。
	$_SESSION["name"] = $name;
    $_SESSION["name_phonetic"] = $name_phonetic;
    $_SESSION["tel"] = $tel;

	
?>

<!DOCTYPE html>
<html>
<head>
<title>確認画面</title>

</head>
<body>
 <?php
//foreachを使って配列内のエラーメッセージを表示
  if(!empty($error_message)){
 	 	foreach ($error_message as $key => $value) {
 	 		echo('<pre>');
 	 		echo $value;
 	 		echo('</pre>');
 	 	}
 	 }

 	 ?>
<!-- <form method="post" action="register.php"> -->
 <tr>
      <td>名前：</td>
      <td><?php echo $name; ?></td>	<br>
      <td>名前カナ：</td>	
      <td><?php echo $name_phonetic; ?></td>	<br>
      <td>電話番号：</td>
      <td><?php echo $tel; ?></td>	<br>
      <input type="button" name="link" value="登録する" onclick="location.href='./register.php' ">
 </tr>
<!--  hiddenで次のページに送る情報を保持する -->
<!-- <input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="name_phonetic" value="<?php echo $name_phonetic; ?>">
<input type="hidden" name="tel" value="<?php echo $tel; ?>"> -->
</form>
</body>
</html>
