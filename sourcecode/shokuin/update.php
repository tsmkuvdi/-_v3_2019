<?php
require_once 'function/shokuin_config.php';
$bangou = (int) $_POST['bangou'];
$shokuin = $_POST['shokuin'];
$shozoku = $_POST['shozoku'];
try {
	if (empty($_POST['shokuinid'])) throw new Exception('Error');
	$id = (int) $_POST['shokuinid'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE $dbtablename SET bangou = ?, shokuin = ?, shozoku = ? WHERE shokuinid = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $bangou, PDO::PARAM_INT);
	$stmt->bindValue(2, $shokuin, PDO::PARAM_STR);
	$stmt->bindValue(3, $shozoku, PDO::PARAM_STR);
	$stmt->bindValue(4, $id, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."登録内容の更新が完了しました。<br>";
echo "<br>";
echo "<a href='shokuin_list.php'>職員一覧に戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}