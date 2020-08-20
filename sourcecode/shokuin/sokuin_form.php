<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>入力フォーム</title>
</head>
<body>
職員登録入力フォーム<br>
<form method="post" action="shokuin_add.php">
職員番号：
<input type="number" min="1" max="1000" name="bangou">
<br>
職員名：
<textarea name="shokuin" cols="16" rows="1" maxlength="10"></textarea>   全て左詰め。例：長野太郎　岳太郎　東京はなこ
<br>
所属：<br>
  <select name="shozoku">

<?php require_once ('function/function_shozoku_html.php'); ?>
           <?php shozoku_Html_Select(); ?>
<!-- php関数呼び出し-->

<!-- 
ファイル名を.htmlにするとphpが機能しない。ファイル名を.phpとしておくこと。
-->


  </select>
<br>
<br>
<input type="submit" value="送信">
<br>
<br>
<a href='sokuin_top.html'>職員管理システムに戻る</a>
</form>
</body>
</html>