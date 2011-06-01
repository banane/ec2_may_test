<?php
/* because of cross-domain issues can't do this in the actual JS */
if($_REQUEST['metric']){
	file_get_contents('http://174.143.153.39/metric3.php?app=mem2&metric='.$_REQUEST['metric']);
}
?>