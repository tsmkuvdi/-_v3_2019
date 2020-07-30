<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>職員検索結果</title>
</head>
<body>
<h3>職員検索結果</h3>
<?php
require_once 'shokuin_config.php';
try {
	if (empty($_POST['kenid'])) throw new Exception('Error');
	$aimaiken = '%'.$_POST['kenid'].'%';
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename where shokuin like '$aimaiken'";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>職員番号</th><th>名前</th><th>所属</th><th></th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";

	        echo "<td>" . htmlspecialchars($row['bangou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shozoku'],ENT_QUOTES,'UTF-8') . "</td>\n";


		echo "<td>\n";
		echo "|<a href=edit.php?shokuinid=" . htmlspecialchars($row['shokuinid'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=predelete.php?shokuinid=" . htmlspecialchars($row['shokuinid'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
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
<div align="left"><a href="shokuin_list.php">職員一覧に戻る</a></div>
</h3>

</body>
</html>
