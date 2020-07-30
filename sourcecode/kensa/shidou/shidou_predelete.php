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
<title>削除確認</title>
</head>
<body>
<h1>削除確認</h1><br>
<h3>以下の指導内容を削除します。</h3>
<br>
<form method="post" action="delete_shidou.php">
<br>
<table width=90% border=1 cellspacing=1>
 <tr>
  <td width=10%>
   日付:
  </td>
  <td>
   <?php echo htmlspecialchars($result['shidouday'], ENT_QUOTES, 'UTF-8'); ?>
  </td>
 <tr>
  <td>
   内容：
  </td>
  <td>
   <?php echo htmlspecialchars($result['naiyou_shidou'], ENT_QUOTES, 'UTF-8'); ?>
  </td>
</table>

<input type="hidden" name="id_shidou" value="<?php echo htmlspecialchars($result['id_shidou'], ENT_QUOTES, 'UTF-8'); ?>">

<br><br>
<input type="submit" value="削除する">
<br><br><br>

<a href='../index.php'>削除せずトップページに戻る</a>
</form>
</body>
</html>