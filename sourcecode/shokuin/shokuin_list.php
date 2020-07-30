<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>職員一覧</title>
</head>
<body>
<h3>職員一覧</h3>


<h3>
<table>
 <th>
<form action = "box_kensaku.php" method="post">
<input type="text" name="kenid">
<input type="submit" name="exec" value="名前検索">
</form>
 </th>
 <th>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='sokuin_top.html'>職員管理システムに戻る</a>
 </th>
<table>
</h3>




<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once 'function/shokuin_config.php';
//try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename ORDER BY bangou";
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


         require_once ('function/function_shozoku.php');
         $tmp = shozokuDisplay_function($row);
  //呼び出し元からは関数内で必要な引数を渡してやる必要がある($row)
  //処理結果を共有するには戻り値で受け取ってやる必要がある($tmp)

		echo "<td>" . htmlspecialchars($tmp ,ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "|<a href=edit.php?shokuinid=" . htmlspecialchars($row['shokuinid'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=predelete.php?shokuinid=" . htmlspecialchars($row['shokuinid'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";

		echo "</tr>\n";
	}
	echo "</table>\n";
	$dbh = null;
/*
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
*/
?>



</body>
</html>
