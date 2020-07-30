<?php
//kensaedit.phpより呼び出し

function kankatsu_select($result){
?>


<option value="1" <?php if($result['kankatsu'] === 1) echo "selected" ?>>本店</option>
<option value="2" <?php if($result['kankatsu'] === 2) echo "selected" ?>>東北支店</option>
<option value="3" <?php if($result['kankatsu'] === 3) echo "selected" ?>>関西支店</option>
<option value="4" <?php if($result['kankatsu'] === 4) echo "selected" ?>>九州支店</option>

<?php

}

?>