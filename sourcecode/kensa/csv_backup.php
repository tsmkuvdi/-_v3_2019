<?php
// エラーを出力する
ini_set('display_errors', "On");

// 出力情報の設定
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=tachiiri_kensa.csv");
header("Content-Transfer-Encoding: binary");


// 変数の初期化
$csv = null;

// 出力したいデータのサンプル
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM $dbtablename AS t1 
                JOIN table_shokuin AS t2 
                ON t1.shokuinbangou1 = t2.bangou  
               LEFT JOIN table_shidou AS t3
               ON t1.id_kensa = t3.id_kensa_merge 
                ORDER BY id_shidou";

/* 縦横入れ替え作成中
    $sql = "SELECT * FROM $dbtablename AS t1 
              (SELECT * 
               MAX(CASE WHEN key = 'naiyou_shidou' THEN value END) AS naiyou_shidou,
                   FROM table_shidou
                   GROUP BY id_kensa_merge;)
            JOIN table_shokuin AS t2 
            ON t1.shokuinbangou1 = t2.bangou  
            LEFT JOIN table_shidou AS t3
               ON t1.id_kensa = t3.id_kensa_merge
                ORDER BY kensaday";
*/


	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 1行目のラベルを作成
$csv = '"検査ID","管轄","防火対象物名","令別表","状況","不備その他内容","立入検査日","主担当名","副担当名","改修計画提出期限","改修計画提出日","改修計画完了期限","改修報告提出日","最終指導日","統合ID（統合指導ID=検査ID)","指導ID","指導日","指導内容"' . "\n";



// 出力データ生成
foreach( $result as $value ) {
	$csv .= '"' . $value['id_kensa'] . '","' . $value['kankatsu'] . '","' . $value['boutainame'] . '","' . $value['beppyou'] . '","' . $value['subject'] . '","' . $value['naiyou'] . '","' . $value['kensaday'] . '","' . $value['shokuin'] . '","' . $value['tantou2'] . '","' . $value['kaishu1'] . '","' . $value['kaishu2'] . '","' . $value['kaishu3'] . '","' . $value['kaishu4'] . '","' . $value['renrakuday']  . '","' . $value['id_kensa_merge']  . '","' . $value['id_shidou']  . '","' . $value['shidouday']  . '","' . $value['naiyou_shidou'] . '"' . "\n";

}


$csv = mb_convert_encoding($csv,"SJIS","UTF-8");

// CSVファイル出力
echo $csv;
return;