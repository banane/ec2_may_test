<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<?php
$num_posts = file_get_contents('http://174.143.153.39/memorialday/index.php?get=1'); // get without inc.
define(FACEBOOK_URL,'http://apps.facebook.com/honormemorial/');
//define(FACEBOOK_URL,'http://apps.facebook.com/annatesterapp/');
define(FACEBOOK_APP_ID,'148380515189785');
//define(FACEBOOK_APP_ID,'151233048268862');

require_once("aws-sdk-for-php/sdk.class.php");
if($_REQUEST['soldierName']){
	  file_get_contents('http://174.143.153.39/metric3.php?app=mem2&metric=php_name_submitted');	  
	 $sdb = new AmazonSDB();
	 $domain = 'mm-memorial-day-live';
	 $new_domain = $sdb->create_domain($domain);

	 if ($new_domain->isOK()){
	  file_get_contents('http://174.143.153.39/metric3.php?app=mem2&metric=php_name_domain_isOK');	  
	  $id = rand(0,1000000);
	
		$add_soldier = $sdb->put_attributes($domain, 'Soldier_'.$id,array('Soldier_name'=>$_REQUEST['soldierName']));
		if($add_soldier->isOK()){
		  file_get_contents('http://174.143.153.39/metric3.php?app=mem2&metric=php_name_added');
		}		
	}  
	if($_POST['submit']){
		// is a form submission, rewrite and upload to s3 file

		$next_token = null;
		$nameStr = '';
		$select_expression = "SELECT Soldier_name FROM `{$domain}` ";
		 
		do {
			if ($next_token)
			{
				$response = $sdb->select($select_expression, array(
					'NextToken' => $next_token,
				));
			}
			else
			{
				$response = $sdb->select($select_expression);
			}
			// store!
			 $items = $response->body->Item(); 

			 foreach($items as $item){
				foreach($item->Attribute as $attribute){
					if(strlen((string)$attribute->Value) < 100){
						$nameStr .= (string)$attribute->Value. "|";
					}
				}
			}
			$next_token = isset($response->body->SelectResult->NextToken)
				? (string) $response->body->SelectResult->NextToken
				: null;
		}
		while ($next_token);		
		// write out to s3
		$s3 = new AmazonS3();
		$response = $s3->create_object('memorialday', 'soldiers.txt', array( 'body' => $nameStr, 'acl'=>AmazonS3::ACL_OPEN));
	}
}
?>
<head> 
<meta property="og:title" content="The Facebook Fallen Veterans Memorial" /> 
<meta property="og:description" content="Honor our fallen veterans by writing a name on the memorial or by laying a wreath. " /> 
<meta property="og:site_name" content="Honor Memorial Day" /> 
<meta property="og:image" content="http://s3.amazonaws.com/memorialday/wreath.png" /> 
<meta property="og:type" content="website" /> 
<meta property="og:url" content="http://apps.facebook.com/honormemorial" /> 
</head> 
<style> 
body {
  font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
//  background: url('') no-repeat fixed;
  padding:0px;
  margin:0px;
}
 
.wall {
  background-image: url("imgs/felt-background.png");
  width:750px;
  height:500px;
  overflow-y:scroll;
  color: #9287AF;
  text-shadow: 0px 1px 0px #ccc;
  line-height:24px;
  padding:5px;
}

.bottom {
  background-image: url("http://s3.amazonaws.com/memorialday/bottom.png");
  width:720px;
  height: 199px;
  margin-top:-85px;
  z-index:1000;
  position:absolute;
  top:565px;
  left:15px;
  cursor: pointer;
}



.blur {-webkit-box-shadow:0 0 1em #fff;-moz-box-shadow:0 0 1em #fff;box-shadow:0 0 1em #fff;}
//.border {border:2px solid #fff};


.add-button {
  vertical-align:middle;
}
</style> 
 
<!-- 
Javascript 
--> 
<script type="text/javascript"> 
var FB_APP_ID = '148380515189785';
var FB_APP_URL = 'http://apps.facebook.com/honormemorial/';

$(document).ready(function(){
	$.post('metrics_js.php?metric=js_load');
//	$('#ie_bottom').hide();
	/* had some dififculty with old PC systems not loading jquery, so version in html */

	$('.bottom').click(function() {
		$.post('metrics_js.php?metric=wreath_click');
		publish();	
	});
 });
 if($){
 	$.post('metrics_js.php?metric=jquery_load');
 }
</script>
<script type="text/javascript">
	function publish(){
		$.post('metrics_js.php?metric=clicked_publish');

		var url = FB_APP_URL;
		var picture = "http://s3.amazonaws.com/memorialday/wreath.png";
		var name = "I laid a wreath to honor our fallen soldiers";
		var caption = "Memorial Day";
		var description = "Join others as we honor the men and women who died defending our country.";
		var properties = {'Wreath #':'<?php echo $num_posts; ?>', 'Goal': '2 Million by Memorial Day'};
		var actionLinks = [{ 'text': 'Lay a Wreath', 'href': url }];
		FB.ui({
     		'method': 'feed',
     		'picture' : picture,
     		'link' : url,
     		'description' : description,
     		'name' : name,
     		'caption' : caption,
     		'properties' : properties,
     		'action_links': actionLinks }, function(response) {
        
       		if (response && response.post_id) {
				$.post('metrics_js.php?metric=post_success');
	            $.post("metrics.php");
	            top.location.href = "<?php echo FACEBOOK_URL;?>/invite.php?fb_force_mode=fbml";
     		} else {
				$.post('metrics_js.php?metric=post_skip');
	            top.location.href = "<?php echo FACEBOOK_URL;?>/invite.php?fb_force_mode=fbml";
     		}
     	});
    }
</script>
<body>
<img src="imgs/logo.png"/>
<br>
Honor our fallen veterans by writing a name on the memorial or by laying a wreath.
<br>
<br>
<div class="wall">
<a href="name.php"><img class="add-button" src="imgs/button.png"></a>
<?php
/* get from s3 */
 /* check if there is incoming soldier to highlight with halo */
 if($_REQUEST['name'] ){
 	$name = $_REQUEST['name']; // from queryString/share
 } else if($_REQUEST['soldierName']){
 	$name = $_REQUEST['soldierName']; // from form submittal
 }
/* end halo check */

$counter = 0;
$breakpoint = 3;
$file = file_get_contents('http://s3.amazonaws.com/memorialday/soldiers.txt');
$soldiers = explode("|", $file);
foreach($soldiers as $soldier){
			if(($name) && ($breakpoint == $counter)){
				echo '<span class="border blur">'.strtoupper($name)."</span>";
				echo "&nbsp;&#149;&nbsp;";
			}
			echo strtoupper($soldier);
			echo "&nbsp;&#149;&nbsp;";
			$counter++;
}
?>
</div>
<div class="bottom"></div>
</body>  
  
<!-- 
Facebook stuff 
--> 
<div id="fb-root"></div> 
<script> 
  window.fbAsyncInit = function() {
    FB.init({appId: '<?php echo FACEBOOK_APP_ID; ?>', status: true, cookie: true,
             xfbml: true})
    window.setTimeout(function() {
      FB.Canvas.setAutoResize();
    }, 250);                  
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
