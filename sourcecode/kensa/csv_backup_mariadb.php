<?php
// 出力情報の設定
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=tachiiri_kensa_server.csv");
header("Content-Transfer-Encoding: binary");


// 変数の初期化
$csv = null;

// 出力したいデータのサンプル
require_once ( __DIR__ .'/config_ken/db_kensaconfig.php');
	$dbh = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM $dbtablename AS t1 JOIN table_shokuin AS t2 ON t1.shokuinbangou1 = t2.bangou ORDER BY kensaday";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 1行目のラベルを作成
$csv = '"ID","管轄","防火対象物名","令別表","状況","不備その他内容","立入検査日","主担当番号","副担当名","改修計画提出期限","改修計画提出日","改修計画完了期限","改修報告提出日","最終指導日","連絡1","連絡2","連絡3","連絡4","連絡5","連絡6","連絡7","連絡8","連絡9","連絡10","連絡11","連絡12","連絡13","連絡14","連絡15","連絡16","連絡17","連絡18","連絡19","連絡20","連絡21","連絡22","連絡23","連絡24","連絡25","連絡26","連絡27","連絡28","連絡29","連絡30","連絡31","連絡32","連絡33","連絡34","連絡35","連絡36","連絡37","連絡38","連絡39","連絡40","連絡41","連絡42","連絡43","連絡44","連絡45","連絡46","連絡47","連絡48","連絡49","連絡50"' . "\n";



// 出力データ生成
foreach( $result as $value ) {
	$csv .= '"' . $value['id'] . '","' . $value['kankatsu'] . '","' . $value['boutainame'] . '","' . $value['beppyou'] . '","' . $value['subject'] . '","' . $value['naiyou'] . '","' . $value['kensaday'] . '","' . $value['shokuinbangou1'] . '","' . $value['tantou2'] . '","' . $value['kaishu1'] . '","' . $value['kaishu2'] . '","' . $value['kaishu3'] . '","' . $value['kaishu4'] . '","' . $value['renrakuday'] . '","' . $value['ren1'] . '","' . $value['ren2'] . '","' . $value['ren3'] . '","' . $value['ren4'] . '","' . $value['ren5'] . '","' . $value['ren6'] . '","' . $value['ren7'] . '","' . $value['ren8'] . '","' . $value['ren9'] . '","' . $value['ren10'] . '","' . $value['ren11'] . '","' . $value['ren12'] . '","' . $value['ren13'] . '","' . $value['ren14'] . '","' . $value['ren15'] . '","' . $value['ren16'] . '","' . $value['ren17'] . '","' . $value['ren18'] . '","' . $value['ren19'] . '","' . $value['ren20'] . '","' . $value['ren21'] . '","' . $value['ren22'] . '","' . $value['ren23'] . '","' . $value['ren24'] . '","' . $value['ren25'] . '","' . $value['ren26'] . '","' . $value['ren27'] . '","' . $value['ren28'] . '","' . $value['ren29'] . '","' . $value['ren30'] . '","' . $value['ren31'] . '","' . $value['ren32'] . '","' . $value['ren33'] . '","' . $value['ren34'] . '","' . $value['ren35'] . '","' . $value['ren36'] . '","' . $value['ren37'] . '","' . $value['ren38'] . '","' . $value['ren39'] . '","' . $value['ren40'] . '","' . $value['ren41'] . '","' . $value['ren42'] . '","' . $value['ren43'] . '","' . $value['ren44'] . '","' . $value['ren45'] . '","' . $value['ren46'] . '","' . $value['ren47'] . '","' . $value['ren48'] . '","' . $value['ren49'] . '","' . $value['ren50'] . '"' . "\n";

}


$csv = mb_convert_encoding($csv,"SJIS","UTF-8");

// CSVファイル出力
echo $csv;
return;