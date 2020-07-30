<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>年別検索結果</title>
</head>
<body>
<h3>年別検索結果</h3>
<?php
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {
	if (empty($_POST['yearid'])) throw new Exception('Error');
	$yearken = $_POST['yearid'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//	$sql = "SELECT * FROM $dbtablename where DATE_FORMAT(kensaday,'%Y')=$yearken";
	$sql = "SELECT * FROM $dbtablename AS t1 JOIN table_shokuin AS t2 ON t1.shokuinbangou1 = t2.bangou where DATE_FORMAT(kensaday,'%Y')=$yearken ORDER BY kensaday";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<tr>\n";
	echo "<th>管轄</th><th>防火対象物名</th><th>令別表</th><th>状況</th><th>不備その他内容</th><th>立入検査日</th><th>主担当名</th><th>副担当名</th><th>改修計画提出期限</th><th>改修計画提出日</th><th>改修計画完了期限</th><th>改修報告提出日</th><th></th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td width=5%>" . htmlspecialchars($row['kankatsu'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['boutainame'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['beppyou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['subject'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kensaday'],ENT_QUOTES,'UTF-8') . "</td>\n";
//		echo "<td>" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou2'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kaishu1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kaishu2'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kaishu3'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kaishu4'],ENT_QUOTES,'UTF-8') . "</td>\n";


		echo "<td>\n";
		echo "|<a href=/kensa/kensaedit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=/kensa/kensapredelete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";


		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>
<h3>
<div align="left"><a href="../index.php">トップページに戻る</a></div>
</h3>
</body>
</html>
