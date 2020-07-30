<?php

ini_set('display_errors', "On");
error_reporting(E_ALL);

require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
require_once ( __DIR__ .'/config_ken/config_post2.php');

try {
	if (empty($_POST['id_kensa'])) throw new Exception('Error');
	$id = (int) $_POST['id_kensa'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "UPDATE $dbtablename 
		SET kankatsu = ?, boutainame = ?, beppyou = ?, subject = ?, 
		naiyou = ?, kensaday = ?, shokuinbangou1 = ?, tantou2 = ?, 
		kaishu1 = ?, kaishu2 = ?, kaishu3 = ?, kaishu4 = ?, 
		renrakuday = ? WHERE id_kensa = ?";
//	$sql.= implode(",",array_map(function($x){return "ren".$x."=?";},range(1,50)));
//	$sql.=" WHERE id_kensa = ?";

	$stmt = $dbh->prepare($sql);
/*
$bind = [];

for($i=1;$i<=50;$i++){
  if(array_key_exists("rensuru".$i,$_POST)){
    $bind[] = $_POST["rensuru".$i];
  }
}
*/
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
	$stmt->bindValue(13, $renrakuday, PDO::PARAM_STR);
/*
foreach($bind as $bindkey=>$bindvalue){
  $stmt->bindValue(($bindkey+14),$bindvalue, PDO::PARAM_STR); //bindValueは14なのでKey+14
}
*/
	$stmt->bindValue(14, $id, PDO::PARAM_STR);
	$stmt->execute();
	$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."立入検査内容の更新が完了しました。<br>";
echo "<br>";
echo "<a href='index.php'>トップページに戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}