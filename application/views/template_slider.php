<?php

    // send raw HTTP headers to set the content type for MS IE
    $this->output->set_header("Content-Type: text/html; charset=UTF-8");

    echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- 90d451425ab834adeab2c83c2eab6b02mochiads.com -->
<head>
<title><?=to_entities($site_name.' | '.$title)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=to_entities($meta_description)?>" />
<meta name="keywords" content="<?=to_entities($meta_keywords)?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="copyright" content="Copyright © 2008-2012 Piron Games" />
<meta name="distribution" content="Global" />
<meta name="rating" content="general" />
<meta name="language" content="en" />
<meta name="og:title" content="<?=$fb_title?>" />
<meta name="og:description" content="<?=$fb_description?>" />
<meta name="og:image" content="<?=$fb_image?>" />
<meta http-equiv="Content-language" content="en" />
<link rel="shortcut icon" href="<?=base_url()?>pirongamesicon.png" type="image/png" />

<link href="<?=base_url()?>res/css/styles.css" rel="stylesheet" type="text/css" media="all" />
<!--[if lt IE 8]><link href="<?=base_url()?>res/css/ie.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->

<?php $this->load->view($js_variables)?>

<script type="text/javascript" src="<?=base_url()?>res/js/jquery-1.7.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>res/js/swfobject_2_2/swfobject.js" charset="utf-8"></script>

<script type="text/javascript" src="<?=base_url()?>res/js/jquery.chocoslider.js"></script>

<!-- Image slider -->
<script type="text/javascript">
  $(window).load(function() {
	$('#slider').chocoslider(
		{
		  auto:true,
		  autoPause:false,
		  speedStrip:500,
		  effect:'fade',
		  numberStrips:2,
		  sliderDelay:3000,
		  transparencytitle:0.75,
		  bChange: function(){},
		  aChange: function(){},
		  chocoEnd: function(){},
		  controlNavigation:true
		}
	);
  });
</script>

<!-- Google +1 Button Script -->
<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>

</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="composite_bkg">
<div id="layout">

	<div id="header" class="clearfix">

		<div class="container">

			<h1 class="logo"><?=anchor('', to_entities($site_name), array('title' => to_entities($meta_description)))?></h1>

		</div>

	</div> <!-- END #HEADER -->

	<div id="wrapper">

		<ul id="mainnav">
			<li><?=anchor('', 'Games')?></li>
			<li><?=anchor('http://www.pirongames.com/blog', 'Blog', array('target' => '_blank'))?></li>
			<li><?=anchor('page/about', 'About')?></li>
		</ul>

		<div id="main" class="clearfix">

			<?php $this->load->view($content_template)?>

		</div>

	</div> <!-- END #WRAPPER -->

<div id="footer" class="clearfix">

	<div class="container">
		<div class="fxcontainer">
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="128" height="96">
				<param name="movie" value="<?=base_url().'res/swf/pironfx.swf'?>" />
				<param name="allowScriptAccess" value="always"/>
				<param name="allowNetworking" value="all"/>
				<param name="quality" value="high"/>
				<param name="scale" value="noscale"/>
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="<?=base_url().'res/swf/pironfx.swf'?>" width="128" height="96" allowScriptAccess="always" allowNetworking="all">
				<!--<![endif]-->
				<div>
					<h1>You need Adobe Flash Player!</h1>
					<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
				</div>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
		</div>

		<!--img src="<?=base_url().'/res/img/footer.png'?>" alt="Footer"/-->
		<p><?='&copy; 2008-'.date('Y').' Piron Games'?></p>
		<ul>
			<li><?=anchor('', 'Games')?></li>
			<li><?=anchor('http://www.pirongames.com/blog', 'Blog', array('target' => '_blank'))?></li>
			<li><?=anchor('page/about', 'About')?></li>
			<li><?=anchor('arcade/browseshared', 'Get Free Games!')?></li>
			<li><?=anchor('http://twitter.com/PironGames', 'Twitter', array('title' => 'Follow on Twitter'))?></li>
			<li><?=anchor('http://www.facebook.com/pages/Piron-Games/357090829925', 'Facebook', array('title' => 'Become a fan!'))?></li>
			<li><?=anchor('feed', 'RSS Feed')?></li>
			<!--TODO: --> <!--li><?=anchor('page/linktopiron', 'Link to Piron!')?></li-->
		</ul>

		<ul>
			<?php foreach($link_exchange_links as $link): ?>
				<li><?=anchor($link->url, $link->display_name, array('title' => $link->display_name))?></li>
			<?php endforeach ?>
		</ul>

		<p><small>Piron is an independent game developer, the author of <?=anchor('http://www.pirongames.com/index.php/arcade/play/1', 'Orbital Decay', array('title' => 'Epic Space Battles'))?> and <?=anchor('http://www.pirongames.com/index.php/arcade/play/17', 'Born of Fire TD', array('title' => 'Might, Magic, Tower Defense'))?>. Browse around and play only the most immersive Flash games ever made. This is hardcore!</small></p>

		<p><small>Uses <?=anchor('http://codeigniter.com', 'CodeIgniter PHP framework', array('target' => '_blank'))?>. Loosely based on <?=anchor('http://www.assembla.com/wiki/show/linkster', 'Linkster', array('target' => '_blank'))?>. Using social icons by <?=anchor('http://www.komodomedia.com/', 'Komodo Media', array('target' => '_blank'))?><br/>
		Rendered in {elapsed_time} seconds - using {memory_usage} of memory.</small></p>
	</div>

</div><!-- END #FOOTER -->

</div> <!-- END #LAYOUT -->
</div> <!-- END #COMPOSITE_BKG -->

</body>
</html>