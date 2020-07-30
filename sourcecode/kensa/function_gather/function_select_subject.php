<?php
//kensaedit.phpより呼び出し

function subject_select($result){
?>

<option value="不備なし" <?php if($result['subject'] === "不備なし") echo "selected" ?>>不備なし</option>
<option value="指導中" <?php if($result['subject'] === "指導中") echo "selected" ?>>指導中</option>
<option value="改修完了" <?php if($result['subject'] === "改修完了") echo "selected" ?>>改修完了</option>
<option value="その他" <?php if($result['subject'] === "その他") echo "selected" ?>>その他</option>


<?php

}

?>