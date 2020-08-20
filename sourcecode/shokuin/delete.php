<?php
require_once 'function/shokuin_config.php';
try {
	if (empty($_POST['shokuinid'])) throw new Exception('Error');/*ここではpostで受け取る。トップページからurlの末尾にid番号指定の場合はgetだが、一度predeleteでgetで受け取った後にこのページに来るため。*/
	$id = (int) $_POST['shokuinid']; //ここではpostで受け取る
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM $dbtablename WHERE shokuinid = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."の削除が完了しました。<br>";
echo "<a href='shokuin_list.php'>職員一覧に戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}