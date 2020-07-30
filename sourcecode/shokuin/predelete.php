<?php
require_once 'function/shokuin_config.php';
try {
	if (empty($_GET['shokuinid'])) throw new Exception('Error');
	$id = (int) $_GET['shokuinid'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE shokuinid = ?";
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
<title>削除確認</title>
</head>
<body>
<h1>削除確認</h1>
<br>
<form method="post" action="delete.php">
<br>

<table width=80% border=1 cellspacing=1>
 <tr><th>職員番号</th><th>名前</th></tr>
 <tr>
  <td width=10%><?php echo htmlspecialchars($result['bangou'], ENT_QUOTES, 'UTF-8'); ?></td>
  <td width=20%><?php echo nl2br(htmlspecialchars($result['shokuin'], ENT_QUOTES, 'UTF-8')); ?></td>


<br>
<input type="hidden" name="shokuinid" value="<?php echo htmlspecialchars($result['shokuinid'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="削除する">
<br>
<br>
<a href='shokuin_list.php'>削除せず一覧に戻る</a>
</form>
</body>
</html>