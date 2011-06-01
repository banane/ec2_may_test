<?php
require_once("aws-sdk-for-php/sdk.class.php");


if(!$sdb){
	 $sdb = new AmazonSDB();
}

if($_REQUEST['item']) && ($_REQUEST['att']){
	// delete
	$success = $sdb->delete_attributes($domain, $_REQUEST['item'], $_REQUEST['att']);
	if($success->isOK()){
		echo '<div style="color:red">';
		echo $_REQUEST['att'] ." deleted.<br></div>";
}

 $domain = 'mm-memorial-day-live';
 $new_domain = $sdb->create_domain($domain); 
 $sql = "SELECT Soldier_name FROM `{$domain}` limit 2500";
 $results = $sdb->select($sql);
echo "<h1>select:</h1>";
 $items = $results->body->Item(); 

foreach($items as $item){
		
		echo $item->Name;
	foreach($item->Attribute as $a){
		echo strtoupper((string)$attribute->Value);
		echo '<a href="test.php?item='.(string)$item->Name.'&att='.(string)$attribute->Value.'">delete</a><br />';
	}
}
?>
