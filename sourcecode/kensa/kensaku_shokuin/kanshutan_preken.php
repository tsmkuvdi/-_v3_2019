<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>職員別立入検査主担当件数一覧</title>
</head>
<body>
<h1>各署職員別立入検査主担当件数一覧</h1>（主担当職員のみ表示）
<a href="../index.php">トップページに戻る</a><br><br>


<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {
	if (empty($_POST['mishidou_kan'])) throw new Exception('Error');
	$shidouken = $_POST['mishidou_kan'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT subject, shokuinbangou1, shokuin, shozoku, 
               COUNT(*) AS kazoeru 
               ,COUNT(subject = '指導中' or null) AS shido 
               ,COUNT(subject = 'その他' or null) AS sonota
               ,COUNT(subject = '改修完了' or null) AS kaikanryo
               ,COUNT(subject = '不備なし' or null) AS nashifubi
               FROM $dbtablename AS t1 
               JOIN table_shokuin AS t2 
               ON t1.shokuinbangou1 = t2.bangou 
               where shozoku = '$shidouken' 
               GROUP BY shokuinbangou1,shokuin,shozoku";

	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "$shidouken";
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>職員番号</th><th>氏名</th><th>主担当件数</th>
              <th></th><th>指導中</th><th>その他</th><th>改修完了</th>
              <th>不備なし</th><th>所属</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shokuin'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kazoeru'],ENT_QUOTES,'UTF-8') . "</td>\n";

		echo "<td>\n";
		echo "<a href=onlyall_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">全ての立入検査</a>\n";
		echo "<a href=onlyshidou_kensa.php?shokuinbangou1=" . htmlspecialchars($row['shokuinbangou1'],ENT_QUOTES,'UTF-8') . ">指導中立入検査</a>\n";
		echo "</td>\n";

		echo "<td>" . htmlspecialchars
                     ($row['shido'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['sonota'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['kaikanryo'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['nashifubi'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars
                     ($row['shozoku'],ENT_QUOTES,'UTF-8') . "</td>\n";


		echo "</tr>\n";
	}

	echo "<th>職員番号</th><th>氏名</th><th>主担当件数</th>
              <th></th><th>指導中</th><th>その他</th><th>改修完了</th>
              <th>不備なし</th><th>所属</th>\n";


	echo "</table>\n";
	$dbh = null;

} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

?>

</body>
</html>
