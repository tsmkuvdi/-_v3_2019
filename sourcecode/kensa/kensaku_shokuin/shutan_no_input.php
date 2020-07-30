<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>立入検査主担当者未入力一覧</title>
</head>
<body>
<h1>立入検査主担当者未入力一覧</h1><br>
<a href="../index.php">トップページに戻る</a><br>
（主担当職員のみ表示）「指導中」の未入力項目一覧。<br>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;
                        charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT subject, shokuinbangou1, shokuin, shozoku, 
                       kensaday, kaishu1, renrakuday, naiyou
               ,COUNT(*) AS kazoeru
               ,COUNT(kensaday = '0000-00-00' or null) AS kenday
               ,COUNT(kaishu1 = '0000-00-00' or null) AS keikakuday
               ,COUNT(renrakuday = '0000-00-00' or null) AS saishuday
               ,COUNT(naiyou = '' or null) AS fubinaiyou
               FROM $dbtablename AS t1 
               JOIN table_shokuin AS t2 
               ON t1.shokuinbangou1 = t2.bangou 
               WHERE subject IN ('指導中')
               GROUP BY shokuinbangou1,shokuin,shozoku";

	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";

	echo "<th>職員番号</th><th>氏名</th><th></th>
              <th>立入検査日<br>未入力</th>
　　　　　　　<th>改修計画<br>提出期限<br>未入力</th>
              <th>最終指導日<br>未入力</th>
              <th>不備内容<br>未入力</th><th>所属</th>\n";

	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=onlyall_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">全立入検査</a>\n";

		echo "</td>\n";

		echo "<td>" . htmlspecialchars
                     ($row['kenday'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['keikakuday'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['saishuday'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['fubinaiyou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shozoku'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "</tr>\n";
	}

	echo "<th>職員番号</th><th>氏名</th><th></th>
              <th>立入検査日<br>未入力</th>
　　　　　　　<th>改修計画<br>提出期限<br>未入力</th>
              <th>最終指導日<br>未入力</th>
              <th>不備内容<br>未入力</th><th>所属</th>\n";

	echo "</table>\n";
	$dbh = null;

} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

?>

</body>
</html>
