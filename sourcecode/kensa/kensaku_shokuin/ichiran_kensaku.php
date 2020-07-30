<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>立入検査・職員一覧検索</title>
</head>
<body>
<h1>立入検査・職員一覧検索システム</h1>
<?php
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename where shokuinbangou1 = ?;";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table  width=100% border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>管轄</th><th>防火対象物名</th><th>令別表</th><th>状況</th><th>不備その他内容</th><th>立入検査日</th><th>番号</th><th>主担当名</th><th>番号</th><th>副担当名</th><th>改修計画提出期限</th><th>改修計画提出日</th><th>改修計画完了期限</th><th>改修報告提出日</th><th></th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['month'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['day'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . nl2br(htmlspecialchars($row['naiyou'],ENT_QUOTES,'UTF-8')) . "</td>\n";
		echo "<td>" . htmlspecialchars($row['tantou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		if ($row['category'] === '1') $tmp = "届出 報告書 その他";
		if ($row['category'] === '2') $tmp = "危険物";
		if ($row['category'] === '3') $tmp = "設備";
		if ($row['category'] === '4') $tmp = "防管協";
		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";
		//echo "<td>" . htmlspecialchars($row['category'],ENT_QUOTES,'UTF-8') . "</td>\n";
		if ($row['shinkou'] === '1') $zap = "未了";
		if ($row['shinkou'] === '2') $zap = "済";
		echo "<td>" . htmlspecialchars($zap ,ENT_QUOTES,'UTF-8') . "</td>\n";
		//echo "<td>" . htmlspecialchars($row['shinkou'],ENT_QUOTES,'UTF-8') . "</td>\n";

/*  これだとクリックですぐに削除される。
		echo "<td>\n";
		echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=delete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";
*/

		echo "<td>\n";
		echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=predelete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
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
<table  width=100%>
<tr>
<th>
<div align="left"><a href="list.php">一覧に戻る</a></div>
</th>
<th>
<FORM>
<div align="left"><INPUT TYPE="button" VALUE="再読込" onClick="window.location.reload();"></div>
</FORM>
</th>
<th>
<div align="left">その他 引継</div>
</th>
</tr>
<table>
</h3>



</body>
</html>
