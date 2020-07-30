<?php
// エラーを出力する
ini_set('display_errors', "On");

try {
	if (empty($_POST['id_kensa'])) throw new Exception('Error');
	$id_kensa = (int) $_POST['id_kensa'];
        $boutainame = $_POST['boutainame'];

} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>指導内容新規入力フォーム</title>
</head>
<body>
<h2><?php echo $boutainame; ?> &nbsp;指導内容新規登録入力フォーム</h2><br>
<form method="post" action="add_shidou.php">

<input type="hidden" name="id_kensa_merge" value="<?php echo $id_kensa; ?>">
<input type="hidden" name="boutainame" value="<?php echo $boutainame; ?>">


日付：
<input type="date" name="shidouday" >&nbsp;&nbsp;&nbsp;&nbsp;＊注意!!Google Chromeしか動作しません。
<br><br>
内容：&nbsp;時分
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来署、電話、出向
<br>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相手方： 担当：&nbsp;&nbsp;これらを入力すること。
<br>
<textarea name="naiyou_shidou" cols="40" rows="6" maxlength="400"></textarea>



<br>
<br>
<input type="submit" value="送信">
<br>
<br>
<a href='/kensa/kensa_top.php'>入力せずトップページに戻る</a>
</form>
</body>
</html>