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
<title>職員登録変更入力フォーム</title>
</head>
<body>
職員登録内容変更<br>
<form method="post" action="update.php">
<br>
番号:<input type="number" name="bangou" value="<?php echo htmlspecialchars($result['bangou'], ENT_QUOTES, 'UTF-8'); ?>">
職員:<input type="text" name="shokuin" value="<?php echo htmlspecialchars($result['shokuin'], ENT_QUOTES, 'UTF-8'); ?>"><br>
<br>
所属：
<select name="shozoku">

<?php require_once 'function/function_select_shozoku.php'; ?> 
     <?php shozoku_select($result);  ?>  <!-- 呼び出し-->

</select>
<br>
<input type="hidden" name="shokuinid" value="<?php echo htmlspecialchars($result['shokuinid'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="送信">
<br>
<br>
<a href='shokuin_list.php'>変更せず職員一覧に戻る</a>
</form>
</body>
</html>