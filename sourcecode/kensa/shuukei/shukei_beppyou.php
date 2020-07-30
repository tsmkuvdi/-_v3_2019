<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>令別表集計表</title>
</head>
<body>
<h1>令別表集計表</h1>

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
               SELECT kankatsu, beppyou,  
               COUNT(*) AS total
               ,COUNT(kankatsu = '1' or null) AS ichiban
               ,COUNT(kankatsu = '2' or null) AS nibanme
               ,COUNT(kankatsu = '3' or null) AS sanbanme
               ,COUNT(kankatsu = '4' or null) AS yonbanme
               FROM $dbtablename 
               GROUP BY beppyou
               WITH ROLLUP
               ";




	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table border=1 cellspacing=1> \n";
	echo "<tr>\n";
	echo "<th>令別表</th><th>本店</th><th>東北支店</th><th>関西支店</th><th>九州支店</th><th>計</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";

		echo "<td>" . htmlspecialchars($row['beppyou'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['ichiban'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['nibanme'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['sanbanme'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['yonbanme'],ENT_QUOTES,'UTF-8') . "</td>\n";
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
