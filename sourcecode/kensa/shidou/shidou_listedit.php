<?php
// エラーを出力する
ini_set('display_errors', "On");

require_once ( __DIR__ .'/../config_ken/db_kensaconfig.php');
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*	$sql = "SELECT * FROM $dbtablename AS t1 
                JOIN table_shokuin AS t2 
                ON t1.shokuinbangou1 = t2.bangou  
                WHERE id_kensa = ?";

 下記のSQL、table_shidouにデータが無い場合、全てが空白に
 なるのでLEFT JOINとした。
*/

	$sql = "SELECT * FROM $dbtablename AS t1 
                JOIN table_shokuin AS t2 
                ON t1.shokuinbangou1 = t2.bangou  
               LEFT JOIN table_shidou AS t3
               ON t1.id_kensa = t3.id_kensa_merge 
               WHERE id_kensa = ?";



	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>立入検査指導内容編集</title>
</head>
<body>
<center>
<table width=80%>
 <tr>
  <td align=center>
<h2>立入検査指導内容編集</h2>
  </td>
 </tr>
</table>
<table  width=80%>
 <tr>
  <td>

   <div align="left">
    <form action="form_shidou.php" method="post">
      <input type="submit"  name="submit" value="指導内容新規登録">
      <input type="hidden" name="id_kensa" value="<?php echo htmlspecialchars($result['id_kensa'], ENT_QUOTES, 'UTF-8'); ?>">
      <input type="hidden" name="boutainame" value="<?php echo htmlspecialchars($result['boutainame'], ENT_QUOTES, 'UTF-8'); ?>">


    </form>
   </div>
  </td>
 </tr>
 <tr>
  <td>
   <div align="right"><a href="../index.php">トップページに戻る</a></div>
  </td>
 </tr>
</table>
<table width=80% border=1 cellspacing=1>
 <tr>
  <td width=23%>
管轄：
<?php echo htmlspecialchars($result['kankatsu'],ENT_QUOTES,'UTF-8'); ?>

  </td>
  <td>
令別表：
<?php echo htmlspecialchars($result['beppyou'],ENT_QUOTES,'UTF-8'); ?>

  </td>
  <td colspan=2>
状況：
<?php echo htmlspecialchars($result['subject'],ENT_QUOTES,'UTF-8'); ?>

  </td>
 </tr>
 <tr>
  <td colspan="2">
防火対象物名：
<?php echo htmlspecialchars($result['boutainame'],ENT_QUOTES,'UTF-8'); ?>
  </td>
  <td colspan=2>
最終指導日:
<?php echo htmlspecialchars($result['renrakuday'],ENT_QUOTES,'UTF-8'); ?>
  </td>
 </tr>
 <tr>
  <td>
立入検査日　　　:
<?php echo htmlspecialchars($result['kensaday'],ENT_QUOTES,'UTF-8'); ?>
  </td>
  <td>
主担当職員：
<?php echo htmlspecialchars($result['shokuin'],ENT_QUOTES,'UTF-8'); ?>
  </td>
  <td colspan=2>
副担当職員：
<?php echo htmlspecialchars($result['tantou2'],ENT_QUOTES,'UTF-8'); ?>
  </td>
 </tr>
 <tr>
  <td>
改修計画提出期限:
<?php echo htmlspecialchars($result['kaishu1'],ENT_QUOTES,'UTF-8'); ?>
  </td>
  <td colspan="3">
不備内容・経過・その他詳細:
  </td>
 <tr>
  <td>
改修計画提出日　:
<?php echo htmlspecialchars($result['kaishu2'],ENT_QUOTES,'UTF-8'); ?>
  </td>
  <td colspan="2" rowspan="3">
<?php echo nl2br(htmlspecialchars($result['naiyou'],ENT_QUOTES,'UTF-8')); ?>
  </td>
 </tr>
 <tr>
  <td>
改修計画完了期限:
<?php echo htmlspecialchars($result['kaishu3'],ENT_QUOTES,'UTF-8'); ?>
  </td>
 </tr>
  <td>
改修報告提出日　:
<?php echo htmlspecialchars($result['kaishu4'],ENT_QUOTES,'UTF-8'); ?>
  </td>
 </tr>
</table>


<br>

<?php
require_once ( __DIR__ .'/../config_ken/db_config_shidou.php');
try {
	$id = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM $dbtablename
               WHERE id_kensa_merge = ?
               ORDER BY shidouday,id_shidou ASC";

	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo "<table  width=80% border=1 cellspacing=1> \n";

	echo "<tr>\n";
	echo "<th>指導日</th><th>指導内容</th>\n";
	echo "</tr>\n";

     foreach ($result as $row) { 
echo "<tr>\n";
 echo "<td width=20%>" . htmlspecialchars($row['shidouday'],ENT_QUOTES,'UTF-8') . "</td>\n";
 echo "<td width=70%>" . nl2br(htmlspecialchars($row['naiyou_shidou'],ENT_QUOTES,'UTF-8')) . "</td>\n";


		echo "<td>\n";
		echo "<a href=naiyou_shidou_edit.php?id=" . htmlspecialchars($row['id_shidou'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "<a href=shidou_predelete.php?id=" . htmlspecialchars($row['id_shidou'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";




echo "</tr>\n";
       }
	echo "</table>\n";
	$dbh = null;
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
?>



</center>
</body>
</html>
