<?
define(FACEBOOK_APP_ID,'148380515189785');
define(FACEBOOK_URL,'http://apps.facebook.com/honormemorial/');
define(FACEBOOK_SECRET,'b2471764b3539cf296e61c83d0b39cf4');


?>

<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml"> 
  <head>    
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
  <link href="http://momentusmedia.com/publisher/static/css/default.css" rel="stylesheet" type="text/css" /> 
   
  
 
<!DOCTYPE html> 
<meta property="og:title" content="The Facebook Fallen Veterans Memorial" /> 
<meta property="og:description" content="Honor our fallen veterans by writing a name on the memorial or by laying a wreath. " /> 
<meta property="og:site_name" content="Honor Memorial Day" /> 
<meta property="og:image" content="https://s3.amazonaws.com/memorialday/wreath.png" /> 
<meta property="og:type" content="website" /> 
<meta property="og:url" content="http://apps.facebook.com/honormemorial/" /> 
 
<style>
  body {
    font-size:12px;
    font-family:verdana;
  }
  .gift-box {
  }
  .gift {
    float:left;
    border:1px solid white;
    padding:3px;
    margin:5px;
  }
  
  .gift:hover {
    border:1px solid black;
    background-color: #627AAD;
    border: 1px solid #1D4088;
    color: #fff;
  }
  
  .gift.selected{}
  .gift div {
    text-align:center;
    padding: 4px 0px;
  }
  
  .post-box {
    border:1px solid #777;
    padding:10px;
    width: 400px;
    text-align:left;
    vertical-align:middle;
    margin:5px;
    position:relative;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, .25);
    -webkit-box-shadow: 1px 1px 3px rgba(0, 0, 0, .25);
  }
  
  .post-box.sent{
    opacity: 0.5;
    filter: alpha(opacity = 50);
  }
  .post-box img{
    vertical-align:middle;
  }
  
  .post-box .name  {
    padding:0px 10px 0px 10px;
  }
  
  .fb-button {
    text-decoration: none;
    background-color: #5B74A8;
    background-position: 0 -48px;
    border-color: #29447E #29447E #1A356E;
    background-image: url(http://174.143.153.39/sandbox/chris/flowers/fb_button_bg.png);
    border: 1px solid #000;
    box-shadow: 0 1px 0 rgba(0, 0, 0, .1);
    -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .1);
    cursor: pointer;
    display: -moz-inline-box;
    display: inline-block;
    font-size: 11px;
    font-weight: bold;
    line-height: normal !important;
    padding: 5px 6px;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    white-space: nowrap;
    color: #fff;
  }
  .post-box .sent-thanks {
    position:absolute; 
    top:25px; 
    right:10px;
    display:none;
    font-weight:bold;
    font-size:1.2em;
  }
  .post-box.sent .sent-thanks {
    display:block;

  }
  
  .post-box.sent .fb-button {
    display:none;
  }
</style>

<script>
  $.post("metrics_js?metric=done_load");
</script>
</head>
<body>
<center> 
<div class="top-spacer"></div> 
<div> 
  <center> 
  <h3> 
    "Like" this to show your support for our troops!  </h3> 
  </center> 
<div class="small-spacer"></div> 
<center> 
<div class="main-block" style="display:inline-block;"> 
  <div class="content-block"> 
          <fb:like-box profile_id="135503066513353" connections="0" stream="0" header="0" style="width: 300px;"></fb:like-box> 
      </div> 
    </div> 
  </div> 
   
  <div class="medium-spacer"></div> 
 </center> 
  <iframe width='728' height='90' frameborder='no' framespacing='0' scrolling='no'  src='http://ads.lfstmedia.com/fbslot/slot5050?ad_size=728x90&adkey=94c'></iframe></div> 
 
 
<div class="footer"> 
  <a target="_TOP" href="http://momentusmedia.com/publisher/index.php/momentus/privacy">Privacy Policy</a> 
</div> 

<div id="fb-root"></div> 
 
<script src="http://connect.facebook.net/en_US/all.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript" charset="utf-8"> 
  window.fbAsyncInit = function() {
    FB.init({appId: '<?=FACEBOOK_APP_ID?>', status: true, cookie: true,
             xfbml: true})
    window.setTimeout(function() {
      FB.Canvas.setAutoResize();
    }, 250);         
    //FB.Canvas.setSize();             
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
  
  
 
 
</script> 
</body> 
</html> 
  

