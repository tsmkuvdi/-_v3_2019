<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>完全未指導件数一覧</title>
</head>
<body>
<h1>立入検査未指導件数一覧</h1>（指導中.主担当職員のみ表示）（立入検査日から35日以上経過しているもの）<br>
<h3>立入検査後指導を1回も行っていない件数</h3><br>
<a href="../index.php">トップページに戻る</a>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {
	if (empty($_POST['mishidou_kan'])) throw new Exception('Error');
	$shidouken = $_POST['mishidou_kan'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;
                        charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
	$sql = "SELECT subject, shokuinbangou1, shokuin, shozoku, 
               COUNT(*) AS kazoeru
               ,COUNT(subject = '指導中' or null) AS shido 
               FROM $dbtablename AS t1 
               JOIN table_shokuin AS t2 
               ON t1.shokuinbangou1 = t2.bangou 
		WHERE DATE_SUB(CURDATE(),INTERVAL 35 DAY) >= kensaday
		AND subject = '指導中'
                AND ren1 = ''
               GROUP BY shokuinbangou1,shokuin,shozoku";
*/

	$sql = "SELECT subject, shokuinbangou1, shokuin, shozoku, 
               COUNT(*) AS kazoeru
               ,COUNT(subject = '指導中' or null) AS shido 
               FROM $dbtablename AS t1 
               JOIN table_shokuin AS t2 
               ON t1.shokuinbangou1 = t2.bangou 
               LEFT JOIN table_shidou AS t3
               ON t1.id_kensa = t3.id_kensa_merge 
		WHERE DATE_SUB(CURDATE(),INTERVAL 35 DAY) >= kensaday
		AND kankatsu = '$shidouken' 
		AND subject = '指導中'
                AND id_kensa_merge IS NULL 
               GROUP BY shokuinbangou1,shokuin,shozoku";




	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>職員番号</th><th>氏名</th><th>未指導件数</th>
              <th></th><th>所属</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                      ($row['kazoeru'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=onlyall_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">全立入検査</a>\n";
		echo "<a href=onlyshidou_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">指導中立入検査</a>\n";
		echo "</td>\n";


		echo "<td>" . htmlspecialchars
                     ($row['shozoku'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "</tr>\n";
	}

	echo "<th>職員番号</th><th>氏名</th><th>未指導件数</th>
              <th></th><th>所属</th>\n";

	echo "</table>\n";
	$dbh = null;

} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

?>

</body>
</html>
