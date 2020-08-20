<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>立入検査・職員一覧検索</title>
</head>
<body>
<h3>立入検査・職員一覧検索</h3>（立入検査未実施職員含)
<a href="../index.php">トップページに戻る</a><br>


<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../../shokuin/function/shokuin_config.php');
try {
	if (empty($_POST['mishidou_kan'])) throw new Exception('Error');
	$shidouken = $_POST['mishidou_kan'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename where shozoku = '$shidouken' ORDER BY bangou";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "$shidouken";
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
		echo "<a href=all_kensa.php?bangou=" . htmlspecialchars($row['bangou'],ENT_QUOTES,'UTF-8') . ">全ての立入検査</a>\n";
		echo "<a href=shidou_kensa.php?bangou=" . htmlspecialchars($row['bangou'],ENT_QUOTES,'UTF-8') . ">指導中立入検査</a>\n";
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
