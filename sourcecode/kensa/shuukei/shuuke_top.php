<?php
// エラーを出力する
ini_set('display_errors', "On");

require_once ( __DIR__ .'/../config_ken/config_yearsearch.php');

?>




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>全ての立入検査集計</title>	
</head>
<body>
<H1>立入検査集計</H1>

<a href="../index.php">トップページに戻る</a>
<br><br>

<table>
  <tr>
   <td>
      <a href="shukei_toatl.php">状況集計表</a>
   </td>
  </tr>
  <tr>
    <td>
      状況年・年度集計表
    </td>
    <td>
     <form action = "shukei_toatl_nendo.php" method="post">
       <select name="yearid">
        <?php
         foreach($yearsearch as $name => $value){
         echo "<option value={$value}>{$value}</option>";
         }
        ?>
       </select>
      <input type="submit" name="exec" value="集計">
    </form>
   </td>
  </tr>

  <tr>
    <td>
    </td>
  </tr>

  <tr>
    <td>
   <a href="shukei_beppyou.php">令別表集計表</a>
   </td>
  </tr>
  <tr>
   <td>
    令別表年・年度集計表
   </td>
   <td>
        <form action = "shukei_beppyou_nendo.php" method="post">
       <select name="yearid">
        <?php
         foreach($yearsearch as $name => $value){
         echo "<option value={$value}>{$value}</option>";
         }
        ?>
       </select>
      <input type="submit" name="exec" value="集計">
    </form>
   </td>
  </tr>

  <tr>
    <td>
    </td>
  </tr>

  <tr>
   <td>
    年度ごと主担当件数集計表
   </td>
   <td>
        <form action = "shukei_shutan_nendo_kensu.php" method="post">
       <select name="yearid">
        <?php
         foreach($yearsearch as $name => $value){
         echo "<option value={$value}>{$value}</option>";
         }
        ?>
       </select>
      <input type="submit" name="exec" value="集計">
    </form>
   </td>
  </tr>
</table>

</body>
</html>