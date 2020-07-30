﻿<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>全ての立入検査一覧</title>
</head>
<body>
<h1>全ての立入検査一覧</h1>
<h3>
 <table  width=100%>
  <tr>
   <th>
    <div align="left"><a href="index.php">トップページに戻る</a></div>
   </th>
  </tr>
 <table>
</h3>


<?php
// エラーを出力する
//ini_set('display_errors', "On");
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');

try {
        $all_kan =$_POST['all_kan'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename AS t1 JOIN table_shokuin AS t2 
               ON t1.shokuinbangou1 = t2.bangou 
               where kankatsu= '$all_kan'
               ORDER BY kensaday";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>詳細・印刷/入力・編集</th><th>管轄</th><th>防火対象物名</th><th>令別表</th><th>状況</th><th>不備その他内容</th><th>立入検査日</th><th>主担当名</th><th>副担当名</th><th>改修計画提出期限</th><th>改修計画提出日</th><th>改修計画完了期限</th><th>改修報告提出日</th><th>最終指導日</th><th></th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";

		echo "<td>\n";
		echo "<a href=shousai.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') ." >詳細</a>\n";
		echo "<a href=kensaedit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">入力</a>\n";
		echo "</td>\n";
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
		echo "<td>" . htmlspecialchars($row['renrakuday'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=kensapredelete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
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

</body>
</html>
