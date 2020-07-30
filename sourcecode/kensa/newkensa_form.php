<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();
require_once ( __DIR__ .'/config_ken/config_beppyou.php');
require_once ('function_gather/function_kankatsu_html.php');
   //branch_Html_Select() で使用。
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>立入検査新規登録</title>
</head>
<body>
<h2>立入検査新規登録</h2>
<br>
<form method="post" action="uke_hyouji.php">
<font size="4">
管轄：
    <select name="kankatsu" size="4">
      <?php branch_Html_Select(); ?>
    </select>
<br><br>
防火対象物名：
<textarea name="boutainame" cols="40" rows="1" maxlength="40"></textarea>
<br>
令別表：
  <form>
<select name="beppyou">

<?php

foreach($beppyou as $name => $value){
echo "<option value={$value}>{$value}</option>";
}

?>

    </select>
  </form>
<br>
状況：
  <select name="subject">
<option value="不備なし">不備なし</option>
<option value="指導中">指導中</option>
<option value="改修完了">改修完了</option>
<option value="その他">その他</option>
  </select>
<br>
不備内容・その他詳細内容：
<textarea name="naiyou" cols="40" rows="6" maxlength="250"></textarea>
<br>
立入検査日：
<input type="date" name="kensaday" >
<br>
<pre>        主担当<br></pre>
職員番号：
<input type="number" min="1" max="250" name="shokuinbangou1" style="width:50px;">
<br>
<pre>        副担当<br></pre>
氏名：
<input type="text"  placeholder="副担当名を入力。" name="tantou2">
<br>
<br>
改修計画提出期限:
<input type="date" name="kaishu1" >
<br>
改修計画提出日:
<input type="date" name="kaishu2" >
<br>
改修計画完了期限:
<input type="date" name="kaishu3" >
<br>
改修報告提出日:
<input type="date" name="kaishu4" >
<br>

<pre>        <input type="submit"  name="submit" value="送信"></pre>
<br>
<a href='index.php'>入力せずトップページに戻る</a>
</font>
</form>
</body>
</html>