<?php
// エラーを出力する
//ini_set('display_errors', "On");

require_once ( __DIR__ .'/config_ken/config_yearsearch.php');
require_once ('function_gather/function_kankatsu_html.php');
   //branch_Html_Select() で使用。
?>


<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>立入検査管理システム</title>
</head>
<body>
<h1>立入検査管理システム</h1>

<table border=1 cellspacing=1>
 <tr>
  <td>
     各署全ての立入検査を見る
   <form action = "all_list_kensa.php" method="post">
    <select name="all_kan">
      <?php branch_Html_Select(); ?>
    </select>
     <input type="submit" name="exec" value="各署全立入検査">
   </form>
  </td>
  <td>

  </td>
  <td>
   <a href="list_kensa.php">全ての立入検査を見る</a>
  </td>
 <tr>

 <tr>
  <td>
   <form action = "./kensaku/kakusho_year_kensaku.php" method="post">
    <select name="year_kan">
       <?php branch_Html_Select(); ?>
    </select>



     <select name="yearid">
       <?php
        foreach($yearsearch as $name => $value){
        echo "<option value={$value}>{$value}</option>";
        }
       ?>
    </select>
     <input type="submit" name="exec" value="年別検索">
   </form>



  </td>
  <td>

  </td>
  <td>
   <form action = "kensaku/year_kensaku.php" method="post">
     <select name="yearid">
       <?php
        foreach($yearsearch as $name => $value){
        echo "<option value={$value}>{$value}</option>";
        }
       ?>
    </select>
     <input type="submit" name="exec" value="年別検索">
   </form>
  </td>
 </tr>
 <tr>
  <td>
    各署 最終指導日からの経過日数検索
   <form action = "kensaku/saishu_shidou.php" method="post">
    <select name="mishidou_kan">
       <?php branch_Html_Select(); ?>
    </select>

     <input type="number" min="1" max="60" name="dayid" style="width:50px;">
     <input type="submit" name="exec" value="経過日数検索">
   </form>
  </td>
  <td>
  </td>
  <td>
   全署 最終指導日からの経過日数検索
    <form method="post" action="kensaku/allsaishu_shidou.php">
      <input type="number" min="1" max="60" name="dayid" style="width:50px;">
      <input type="submit" name="exec" value="経過日数検索">
    </form>
  </td>
 </tr>

 <tr>
  <td>
    未指導立入検査 
   <form action = "kensaku/shidou_kensaku.php" method="post">
    <select name="mishidou_kan">
      <?php branch_Html_Select(); ?>
    </select>
     <input type="submit" name="exec" value="検索">
   </form>
    立入検査後指導を1回も行っていない件数
   <form action = "kensaku_shokuin/kaku_kensu_mishidou.php" method="post">
    <select name="mishidou_kan">
      <?php branch_Html_Select(); ?>
    </select>
     <input type="submit" name="exec" value="検索">
   </form>

  </td>
  <td>
  </td>
  <td>
    <a href="kensaku/all_mishidou.php">全ての未指導立入検査</a>
     <br>
    <a href="kensaku_shokuin/kensu_mishidou.php">立入検査後指導を1回も行っていない件数</a>
  </td>
 </tr>

 <tr>
  <td>
    各署改修計画提出期限超過一覧
     <form action = "kensaku/kaishu_kigen.php" method="post">
       <select name="mishidou_kan">
          <?php branch_Html_Select(); ?>
       </select>
         <input type="submit" name="exec" value="各署検索">
     </form>
  </td>
  <td>
  </td>
  <td>
    <a href="kensaku/allkaishu_kigen.php">全ての改修計画提出期限超過一覧</a>
  </td>
 </tr>

 <tr>
  <td>
   <form action = "kensaku_shokuin/kan_preken.php" method="post">
    <select name="mishidou_kan" size="4">
       <?php branch_Html_Select(); ?>
   </select>
     <input type="submit" name="exec" value="各署職員一覧"><br>（立入検査未実施職員含）
   </form>
  </td>
  <td>
    <form action = "kensaku_shokuin/kanshutan_preken.php" method="post">
      <select name="mishidou_kan" size="4">
         <?php branch_Html_Select(); ?>
      </select>
       <input type="submit" name="exec" value="各署職員別主担当件数"><br>（主担当職員のみ表示）
    </form>
  </td>
  <td>
    <a href="kensaku_shokuin/preken.php">全ての立入検査・職員一覧検索</a>      （立入検査未実施職員含）
    <br><br>
     <a href="kensaku_shokuin/shutan_preken.php">全ての職員別主担当件数一覧</a>（主担当職員のみ表示）
  </td>
 </tr>

 <tr>
  <td>
   <a href=""></a>
  </td>
  <td>

  </td>
  <td>
   <a href="kensaku_shokuin/shutan_no_input.php">「指導中」未入力一覧</a>
    <br>
   <a href="kensaku_shokuin/kensu_saishu_shidou.php">2ヶ月以上未指導件数一覧</a>

  </td>
 </tr>

 <tr>
  <td>
    各署改修計画完了期限超過一覧
    <form action = "kensaku/kanryo_kigen.php" method="post">
      <select name="mishidou_kan">
         <?php branch_Html_Select(); ?>
      </select>
        <input type="submit" name="exec" value="各署検索">
    </form>
  </td>
  <td>
  </td>
  <td>
    <a href="kensaku/allkanryo_kigen.php">全ての改修計画完了期限超過一覧</a>
  </td>
 </tr>

 <tr>
  <td>
    <form action = "kensaku/kakusho_box_kensaku.php" method="post">
      <select name="kakuken">
         <?php branch_Html_Select(); ?>
      </select>
        <input type="text" name="kenid">
        <input type="submit" name="exec" value="防火対象物検索">
    </form>
  </td>
  <td>

  </td>
  <td>
    <form action = "kensaku/box_kensaku.php" method="post">
     <input type="text" name="kenid">
     <input type="submit" name="exec" value="防火対象物検索">
    </form>
  </td>
 </tr>

 <tr>
  <td>
   
  </td>
  <td>
  </td>
  <td>
    <a href="shuukei/shuuke_top.php">立入検査集計表</a>
  </td>
 </tr>

 <tr>
  <td>
    <a href="newkensa_form.php">立入検査新規登録</a>
  </td>
 </tr>
 <tr>
  <td>
    職員を登録する&nbsp;&nbsp;&nbsp;<a href="../shokuin/sokuin_top.html">職員管理システム</a>
  </td>
 </tr>
 <tr>
  <td colspan="3">
    <a href="https://www.google.com/intl/ja_ALL/chrome/" target="_blank">推奨ブラウザ「GoogleChrome」。</a>
GoogleChrome以外は日付入力が出来ない場合があります。閲覧に支障はありません。
  </td>
 </tr>
 <tr>
  <td colspan="2">
  </td>
  <td>
    <a href="backup_setsumei.html">バックアップ</a>
  </td>
 </tr>


</table>

</body>
</html>
