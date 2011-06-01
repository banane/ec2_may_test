<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<?php
file_get_contents('http://174.143.153.39/metric3.php?app=mem2&metric=php_name_load');
define(FACEBOOK_URL,'http://apps.facebook.com/honormemorial');
//define(FACEBOOK_URL,'http://apps.facebook.com/annatesterapp/');
define(FACEBOOK_APP_ID,'148380515189785');
//define(FACEBOOK_APP_ID,'151233048268862');

$num_posts = file_get_contents('http://174.143.153.39/memorialday/index.php?get=1');
?>
<html>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 

<style type="text/css">
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
#soldierForm, #soldierResult  {
padding:10px;
margin:10px;
}

#addButton {
	background-color:#dedede;
	color:#000;
    font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
    padding:4px;
    font-size:14px;
    border-radius:2px;
    moz-border-radius:2px;
	webkit-border-radius:2px;    
	width:200px;
	text-align:center;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$.post('metrics_js.php?metric=name_js_load');
		$('#addButton').click( function(){
			$.post('metrics_js.php?metric=name_add_click');
	//		publish();		
		});
	});
</script>
<script type="text/javascript">
	function publish(){			
		$.post('metrics_js.php?metric=name_publish');
		var url = "<?php echo FACEBOOK_URL; ?>/index.php?name=" + escape($('#soldierName').val()) ;
		var picture = "http://s3.amazonaws.com/memorialday/wreath.png";
		var name = "I just added "+$('#soldierName').val()+" to the Facebook Fallen Veterans Memorial";
		var caption = "Memorial Day";
		var description = "Lay a wreath on the wall to join me in honoring the men and women who died defending our country. Let\t's lay 2 million wreathes by Memorial Day (May 30).";
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
				$.post('metrics.php?add=1');
				$.post('metrics_js.php?metric=name_publish_success');

//				$('#nameForm').submit();	
//				return true;
			} else {
//				$('#nameForm').submit();				
				$.post('metrics_js.php?metric=name_publish_skip');
//				return true;
			}
			
		});
	}
</script>
<div class="wall">
<div id="soldierForm">
<form method="post" action="index.php" id="nameForm" onSubmit="return publish()">
<h2>Fallen Soldier's Name:</h2>
	<input type="text" name="soldierName" size = "50" value="" id="soldierName">
<br />
<br />
<!--<div id="addButton">Add a Soldier to the Wall</div>-->
<input type="submit" value="Add a Soldier to the Wall" id="addButton" name="submit">
</form>
</div>
</div>
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
