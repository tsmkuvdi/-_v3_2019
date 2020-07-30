<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>年度ごと主担当件数一覧</title>
</head>
<body>
<h1>年度ごと立入検査主担当件数一覧</h1>（主担当職員のみ表示）<br>
<a href="shuuke_top.php">戻る</a></div>

<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');

try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;
                        charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/* 基本SQL
$sql = "
SELECT shokuinbangou1, shokuin, shozoku
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2015')) as count_2015
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2016')) as count_2016
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2017')) as count_2017
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2018')) as count_2018
FROM table_kenoi AS t1 left JOIN table_shokuin AS t2 
     ON t1.shokuinbangou1 = t2.bangou 
GROUP BY shokuinbangou1,shokuin,shozoku";
*/



$sql = "
SELECT shokuinbangou1, shokuin, shozoku
     , COUNT(*) AS kazoeru
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2015')) as count_2015
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2016')) as count_2016
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2017')) as count_2017
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2018')) as count_2018
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2019')) as count_2019
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2020')) as count_2020
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2021')) as count_2021
     , sum((DATE_FORMAT(date_sub(kensaday, INTERVAL 3 MONTH),'%Y')='2022')) as count_2022


FROM $dbtablename AS t1 left JOIN table_shokuin AS t2 
     ON t1.shokuinbangou1 = t2.bangou 
GROUP BY shokuinbangou1,shokuin,shozoku";



	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>職員番号</th><th>氏名</th><th>所属</th>
              <th>2015年度</th><th>2016年度</th><th>2017年度</th><th>2018年度</th>
              <th>2019年度</th><th>2020年度</th><th>2021年度</th><th>2022年度</th>
              <th>主担当件数</th><th></th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shozoku'],ENT_QUOTES,'UTF-8') . "</td>\n";

                echo "<td>" . htmlspecialchars
                      ($row['count_2015'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2016'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2017'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2018'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2019'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2020'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2021'],ENT_QUOTES,'UTF-8') . "</td>\n";
                echo "<td>" . htmlspecialchars
                      ($row['count_2022'],ENT_QUOTES,'UTF-8') . "</td>\n";


		echo "<td>" . htmlspecialchars
                     ($row['kazoeru'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=../kensaku_shokuin/onlyall_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">全立入検査</a>\n";
		echo "<a href=../kensaku_shokuin/onlyshidou_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">指導中立入検査</a>\n";
		echo "</td>\n";

		echo "</tr>\n";
	}

	echo "<th>職員番号</th><th>氏名</th><th>所属</th>
              <th>2015年度</th><th>2016年度</th><th>2017年度</th><th>2018年度</th>
              <th>2019年度</th><th>2020年度</th><th>2021年度</th><th>2022年度</th>
              <th>主担当件数</th><th></th>\n";

	echo "</table>\n";
	$dbh = null;

} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

?>

</body>
</html>
