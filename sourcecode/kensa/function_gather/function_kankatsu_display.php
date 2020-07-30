<?php
//list_kensa.phpから呼び出し
ini_set('display_errors', "On");

function kankatsuDisplay_function($row){
  if ($row['kankatsu'] === '1') $tmp = "本店";
  if ($row['kankatsu'] === '2') $tmp = "東北支店";
  if ($row['kankatsu'] === '3') $tmp = "関西支店";
  if ($row['kankatsu'] === '4') $tmp = "九州支店";

return $tmp;

}

/**
呼び出し元と処理を共有したい場合、多くの場合は切り出しただけでは
期待通りには動作しない。
（変数のスコープ、関数の引数、関数の戻り値)
関数の中で$rowを使うには呼び出し側から渡してもらわないといけない
関数定義時に指定した変数に呼び出し元から渡された値が入って使えるようになる
*/