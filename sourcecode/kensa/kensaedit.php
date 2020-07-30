<?php
// エラーを出力する
ini_set('display_errors', "On");
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename WHERE id_kensa = ?";
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
<title>立入検査内容変更フォーム</title>
</head>
<body>
<h2>立入検査内容変更</h2>

<form method="post" action="update_kensa.php">

<font size="4">
<pre>      <a href='index.php'>変更せずトップページに戻る</a></pre>
<br>
<input type="hidden" name="id_kensa" value="<?php echo htmlspecialchars($result['id_kensa'], ENT_QUOTES, 'UTF-8'); ?>">
<pre>      <input type="submit" value="基本情報を変更する"></pre>
</form>
<table width=100% border=1 cellspacing=1>
 <tr>
  <td>
管轄：

<?php require_once ('function_gather/function_select_kankatsu.php');?>

<select name="kankatsu">
   <?php kankatsu_select($result) ?>
</select>
  </td>
  <td>
令別表：
<?php require_once ( __DIR__ .'/config_ken/config_beppyou.php'); ?>
<select name="beppyou">
  <?php foreach ($beppyou as $value) : ?>
    <?php if ($value == $result['beppyou']) : ?>
      <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
        <?php else: ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
    <?php endif; ?>
  <?php endforeach; ?>
</select>
  </td>
  <td>
状況：
<?php require_once ('function_gather/function_select_subject.php');?>

<select name="subject">
   <?php subject_select($result) ?>
</select>

  </td>
 </tr>
 <tr>
  <td colspan="2">
防火対象物名：<input type="text" name="boutainame" value="<?php echo htmlspecialchars($result['boutainame'], ENT_QUOTES, 'UTF-8'); ?>">
  </td>
  <td>
最終指導日:<input type="date" name="renrakuday" value="<?php echo htmlspecialchars($result['renrakuday'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
 </tr>
 <tr>
  <td>
立入検査日　　　:
<input type="date" name="kensaday" value="<?php echo htmlspecialchars($result['kensaday'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
  <td>
主担当職員番号：
<input type="number" min="1" max="250" name="shokuinbangou1" value="<?php echo htmlspecialchars($result['shokuinbangou1'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
  <td>
副担当氏名：
<input type="text" name="tantou2" value="<?php echo htmlspecialchars($result['tantou2'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
 </tr>
 <tr>
  <td>
改修計画提出期限:
<input type="date" name="kaishu1" value="<?php echo htmlspecialchars($result['kaishu1'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>

  <td colspan="2">
不備内容・経過・その他詳細:
  </td>

 <tr>
  <td>
改修計画提出日　:
<input type="date" name="kaishu2" value="<?php echo htmlspecialchars($result['kaishu2'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
  <td colspan="2" rowspan="3">
<textarea name="naiyou" cols="90" rows="6"><?php echo htmlspecialchars($result['naiyou'], ENT_QUOTES, 'UTF-8'); ?></textarea>
  </td>
 </tr>
 <tr>
  <td>
改修計画完了期限:
<input type="date" name="kaishu3" value="<?php echo htmlspecialchars($result['kaishu3'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
 </tr>
  <td>
改修報告提出日　:
<input type="date" name="kaishu4" value="<?php echo htmlspecialchars($result['kaishu4'] , ENT_QUOTES, 'UTF-8'); ?>">
  </td>
 </tr>

</table>
</font>

</body>
</html>