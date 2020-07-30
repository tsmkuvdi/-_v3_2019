<?php

ini_set('display_errors', "On");

session_start();

require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');

require_once ( __DIR__ .'/config_ken/config_session2.php');

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO $dbtablename (kankatsu, boutainame, beppyou, subject, naiyou, kensaday, shokuinbangou1, tantou2, kaishu1, kaishu2, kaishu3, kaishu4,renrakuday) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $kankatsu, PDO::PARAM_STR);
	$stmt->bindValue(2, $boutainame, PDO::PARAM_STR);
	$stmt->bindValue(3, $beppyou, PDO::PARAM_STR);
	$stmt->bindValue(4, $subject, PDO::PARAM_STR);
	$stmt->bindValue(5, $naiyou, PDO::PARAM_STR);
	$stmt->bindValue(6, $kensaday, PDO::PARAM_STR);
	$stmt->bindValue(7, $shokuinbangou1, PDO::PARAM_INT);
	$stmt->bindValue(8, $tantou2, PDO::PARAM_STR);
	$stmt->bindValue(9, $kaishu1, PDO::PARAM_STR);
	$stmt->bindValue(10, $kaishu2, PDO::PARAM_STR);
	$stmt->bindValue(11, $kaishu3, PDO::PARAM_STR);
	$stmt->bindValue(12, $kaishu4, PDO::PARAM_STR);
	$stmt->bindValue(13, $kensaday, PDO::PARAM_STR);
	$stmt->execute();
	$dbh = null;

 session_destroy();

	echo "立入検査の登録が完了しました。<br>";
echo "<a href='index.php'>トップページに戻る</a>";
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

