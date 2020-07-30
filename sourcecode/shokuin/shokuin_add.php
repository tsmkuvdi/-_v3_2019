<?php
require_once 'function/shokuin_config.php';
$bangou = (int) $_POST['bangou'];
$shokuin = $_POST['shokuin'];
$shozoku = $_POST['shozoku'];
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO $dbtablename (bangou, shokuin, shozoku) VALUES (?, ?, ?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $bangou, PDO::PARAM_INT);
	$stmt->bindValue(2, $shokuin, PDO::PARAM_STR);
	$stmt->bindValue(3, $shozoku, PDO::PARAM_STR);
	$stmt->execute();
	$dbh = null;
	echo "職員登録が完了しました。<br>";
echo "<a href='sokuin_top.html'>職員管理システムに戻る</a>";
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}