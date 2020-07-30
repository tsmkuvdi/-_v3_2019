<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>全ての未指導立入検査検索結果</title>
</head>
<body>
<h3>全ての未指導立入検査検索結果</h3>
（立入検査日から35日以上経過しているもの)
<h3>
<div align="left"><a href="../index.php">トップページに戻る</a></div>
</h3>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {

	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
	$sql = "SELECT * FROM $dbtablename AS t1 
		JOIN table_shokuin AS t2 
		ON t1.shokuinbangou1 = t2.bangou 
		where subject = '指導中' 
		AND ren1 = '' 
		ORDER BY kensaday";
*/
	$sql = "SELECT * FROM $dbtablename AS t1 
		JOIN table_shokuin AS t2 
		ON t1.shokuinbangou1 = t2.bangou 
               LEFT JOIN table_shidou AS t3
               ON t1.id_kensa = t3.id_kensa_merge 
		WHERE DATE_SUB(CURDATE(),INTERVAL 35 DAY) >= kensaday
		AND subject = '指導中'
                AND id_kensa_merge IS NULL 
		ORDER BY kensaday";

//表結合時片方にデータが無いものの抽出はIS NULL

	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<tr>\n";
	echo "<th>詳細・印刷</th><th>管轄</th><th>防火対象物名</th>
              <th>令別表</th><th>状況</th><th>不備その他内容</th>
              <th>立入検査日</th><th>主担当名</th><th>副担当名</th>
              <th>改修計画提出期限</th>
              \n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<td>\n";
		echo "<a href=../shousai.php?id=" . htmlspecialchars($row['id_kensa'],ENT_QUOTES,'UTF-8') . " >詳細</a>\n";
		echo "</td>\n";
		echo "<td>" . htmlspecialchars($row['kankatsu'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['boutainame'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['beppyou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['subject'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kensaday'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou2'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kaishu1'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>

</body>
</html>
