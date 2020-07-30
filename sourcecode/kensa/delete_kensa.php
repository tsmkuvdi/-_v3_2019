<?php
// エラーを出力する
ini_set('display_errors', "On");

//基本情報削除
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
try {
	if (empty($_POST['id_kensa'])) throw new Exception('Error');/*ここではpostで受け取る。トップページからurlの末尾にid番号指定の場合はgetだが、一度predeleteでgetで受け取った後にこのページに来るため。*/
	$id = (int) $_POST['id_kensa'];//ここではpostで受け取る
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM $dbtablename WHERE id_kensa = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."の基本情報の削除が完了しました。<br>";

} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}



//指導内容削除
require_once ( __DIR__ .'/config_ken/db_config_shidou.php');

try {
	if (empty($_POST['id_kensa'])) throw new Exception('Error');
        $id_kensa_merge = (int) $_POST['id_kensa'];


	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM $dbtablename WHERE id_kensa_merge = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id_kensa_merge, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."の指導内容の削除が完了しました。<br>";
echo "<a href='index.php'>トップページに戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}