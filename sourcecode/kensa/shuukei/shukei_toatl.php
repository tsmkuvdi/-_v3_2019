<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>立入検査集計表</title>
</head>
<body>
<h1>立入検査集計表</h1>


<?php
// エラーを出力する
//ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');

try {
	$dbh = new PDO("mysql:host=localhost;
                        dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT MAX(kensaday) AS kennew, MIN(kensaday) AS kenold
                FROM $dbtablename";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}


?>


 <table>
  <tr>
   <th>
     <h3><div align="right"><a href="shuuke_top.php">戻る</a></div>
     全期間集計&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($result['kenold'],ENT_QUOTES,'UTF-8').' ～ '.htmlspecialchars($result['kennew'],ENT_QUOTES,'UTF-8'); ?></h3>
   </th>
  </tr>
 </table>



<?php
// エラーを出力する
//ini_set('display_errors', "On");
require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');

try {
	$dbh = new PDO("mysql:host=localhost;
                        dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "
               SELECT kankatsu, subject,   
               COUNT(*) AS total
               ,COUNT(subject = '不備なし' or null) AS fubinashi 
               ,COUNT(subject = '指導中' or null) AS shidouchu
               ,COUNT(subject = '改修完了' or null) AS kanryou
               ,COUNT(subject = 'その他' or null) AS sonota
               FROM $dbtablename 
               GROUP BY  kankatsu
               WITH ROLLUP
               ";

	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>管轄</th><th>不備なし</th><th>指導中</th>
              <th>改修完了</th><th>その他</th><th>計</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";

		echo "<td>" . htmlspecialchars($row['kankatsu'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['fubinashi'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['shidouchu'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['kanryou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['sonota'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['total'],ENT_QUOTES,'UTF-8') . "</td>\n";


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
