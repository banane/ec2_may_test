<?php
define(FACEBOOK_URL,'http://apps.facebook.com/honormemorial');
?>
<?if($_REQUEST['fb_sig_in_iframe']):?>
  <script>
//    top.location.href = "<? echo FACEBOOK_URL;?>invite/<?=$instance->id?>/?fb_force_mode=fbml";
  </script>
  <?exit;?>
<?endif;?>


<fb:iframe width="1" height="1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" src="http://174.143.153.39/lftarget.html"></fb:iframe>


<fb:fbml> 
<fb:request-form 
  action="<?php echo FACEBOOK_URL; ?>/done.php" 
  method="POST" 
  invite="true" 
  type="Honor Memorial Day" 
  content="Join us in honoring fallen soldiers for Memorial Day. <?php echo htmlentities("<fb:req-choice url=\"".FACEBOOK_URL."\" label=\"Authorize My Application\">") ?>" >
  <fb:multi-friend-selector 
    showborder="false" 
    actiontext="Join us in laying wreathes to honor the men and women who died for our country."> 
</fb:request-form> 
</fb:fbml>


