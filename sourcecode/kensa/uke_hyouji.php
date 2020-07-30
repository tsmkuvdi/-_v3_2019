<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once ( __DIR__ .'/config_ken/config_SessionPost.php');

?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>出力結果</title>
</head>
<body>
<h2>立入検査新規登録確認</h2>


<?php
// print_r($_POST);

$errors = array();

if (isset($_POST['submit'])) {

require_once ( __DIR__ .'/config_ken/config_post.php');


	if ($boutainame === "") {
	$errors['boutainame'] = "防火対象物名が入力されていません。";
	}
	if ($kensaday === "") {
	$errors['kensaday'] = "立入検査日が入力されていません。";
	}
	if ($shokuinbangou1 === "") {
	$errors['shokuinbangou1'] = "主担当-職員番号が入力されていません。";
	}
	if ($tantou2 === "") {
	$errors['tantou2'] = "副担当氏名が入力されていません。";
	}
}


echo "<ul>";
foreach($errors as $value){
 echo "<li>";
 echo $value;
 echo "</li>";
}
echo "</ul>";

echo "<br>";
echo "管　　　　轄:";
echo htmlspecialchars($_POST['kankatsu'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "防火対象物名:";
echo htmlspecialchars($_POST['boutainame'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "令　別　表:";
echo htmlspecialchars($_POST['beppyou'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "状　　　　況:";
echo htmlspecialchars($_POST['subject'],ENT_QUOTES,'UTF-8');
echo "<br>";
 echo "<table>";
  echo "<tr>";
   echo "<td>";
echo "不備内容・その他詳細内容:";
   echo "</td>";
   echo "<td>";
echo nl2br(htmlspecialchars($_POST['naiyou'],ENT_QUOTES,'UTF-8'));
   echo "</td>";
  echo "</tr>";
 echo "</table>";
echo "<br>";
echo "立入検査日:";
echo htmlspecialchars($_POST['kensaday'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "主担当番号・名前・所属:";
if (is_numeric($_POST['shokuinbangou1'])) {
	echo number_format($_POST['shokuinbangou1']);
}

require_once ( __DIR__ .'/../shokuin/function/shokuin_config.php');
$postbangou1 = $_POST['shokuinbangou1'];
try {
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename where bangou = $postbangou1";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) {
		echo "&nbsp;&nbsp;";
		echo htmlspecialchars($row['shokuin'],ENT_QUOTES,'UTF-8') ;
		echo "&nbsp;&nbsp;";
		echo htmlspecialchars($row['shozoku'],ENT_QUOTES,'UTF-8') ;
	}
	$dbh = null;
} catch (PDOException $e) {
	echo "エラー発生。主担当番号が入力されていません。: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}
echo "<br>";
echo "副担当氏名:";
echo htmlspecialchars($_POST['tantou2'],ENT_QUOTES,'UTF-8');

require_once ( __DIR__ .'/../shokuin/function/shokuin_config.php');

echo "<br>";
echo "<br>";

echo "改修計画提出期限:";
echo htmlspecialchars($_POST['kaishu1'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "改修計画提出日:";
echo htmlspecialchars($_POST['kaishu2'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "改修計画完了期限:";
echo htmlspecialchars($_POST['kaishu3'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo "改修報告提出日:";
echo htmlspecialchars($_POST['kaishu4'],ENT_QUOTES,'UTF-8');
echo '<br><br>';

if ( $boutainame === "" || $kensaday === "" || $shokuinbangou1 === "" || $tantou2 === "") { 
      echo '<a href="newkensa_form.php">エラー再入力 戻る</a>';
    } else {
      echo '<form action="kensa_add.php" method="post">';
      echo '<input type="submit" name="submit" value="エラーが無いので登録する">';
      echo '</form>';
}

?>


</body>
</html>