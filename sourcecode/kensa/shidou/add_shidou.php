<?php
require_once ( __DIR__ .'/../config_ken/db_config_shidou.php');
require_once ( __DIR__ .'/../config_ken/config_post_shidou.php');

if  (empty ($_POST['shidouday'])) {
    echo '指導日が空白です。<br>';
    echo "<a href='/kensa/kensa_top.php'>トップページに戻る</a>";
 } elseif (empty($_POST['naiyou_shidou'])) {
    echo '指導内容が空白です。<br>';
    echo "<a href='/kensa/kensa_top.php'>トップページに戻る</a>";
 } else {

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO $dbtablename (shidouday, naiyou_shidou, id_kensa_merge) VALUES (?, ?,?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $shidouday, PDO::PARAM_STR);
	$stmt->bindValue(2, $naiyou_shidou, PDO::PARAM_STR);
	$stmt->bindValue(3, $id_kensa_merge, PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "$boutainame"."の指導内容登録が完了しました。<br>";
echo "<a href='../index.php'>トップページに戻る</a>";
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
}