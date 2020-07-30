<?php
require_once ( __DIR__ .'/../config_ken/db_config_shidou.php');
require_once ( __DIR__ .'/../config_ken/config_post_shidou.php');

try {
	if (empty($_POST['id_shidou'])) throw new Exception('Error');
	$id = (int) $_POST['id_shidou'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE $dbtablename SET shidouday = ?
                , naiyou_shidou = ?, id_kensa_merge = ?
                WHERE id_shidou = ?"; 
                          //主キーは最後にWHERE
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $shidouday, PDO::PARAM_STR);
	$stmt->bindValue(2, $naiyou_shidou, PDO::PARAM_STR);
	$stmt->bindValue(3, $id_kensa_merge, PDO::PARAM_INT);
	$stmt->bindValue(4, $id, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."指導内容の更新が完了しました。<br>";
echo "<br>";
echo "<a href='../index.php'>トップページに戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}