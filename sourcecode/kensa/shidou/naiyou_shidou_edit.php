<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_config_shidou.php');


try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE id_shidou = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="option_select.css">

<title>指導内容変更入力フォーム</title>
</head>
<body>
<h3>指導内容変更フォーム</h3><br>
<form method="post" action="update_naiyou_shidou.php">
<br>
日付:
<input type="date" name="shidouday" value="<?php echo htmlspecialchars($result['shidouday'], ENT_QUOTES, 'UTF-8'); ?>">
<br>

指導内容：<br><br>
時分 
来署、電話、出向 
相手方： 担当：  ←これらを入力すること。<br>
<textarea name="naiyou_shidou" cols="80" rows="20"><?php echo htmlspecialchars($result['naiyou_shidou'], ENT_QUOTES, 'UTF-8'); ?></textarea>
<br>
<input type="hidden" name="id_shidou" value="<?php echo htmlspecialchars($result['id_shidou'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="hidden" name="id_kensa_merge" value="<?php echo htmlspecialchars($result['id_kensa_merge'], ENT_QUOTES, 'UTF-8'); ?>">

<input type="submit" value="送信">
<br>
<br>
<a href='../index.php'>変更せずトップページに戻る</a>
</form>
</body>
</html>