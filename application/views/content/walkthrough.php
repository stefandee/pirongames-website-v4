	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>    

	<!-- Project Wonderful Ad Box Loader -->
	<!-- Put this after the <body> tag at the top of your page -->
	<script type="text/javascript">
	   (function(){function pw_load(){
		  if(arguments.callee.z)return;else arguments.callee.z=true;
		  var d=document;var s=d.createElement('script');
		  var x=d.getElementsByTagName('script')[0];
		  s.type='text/javascript';s.async=true;
		  s.src='//www.projectwonderful.com/pwa.js';
		  x.parentNode.insertBefore(s,x);}
	   if (window.attachEvent){
		window.attachEvent('DOMContentLoaded',pw_load);
		window.attachEvent('onload',pw_load);}
	   else{
		window.addEventListener('DOMContentLoaded',pw_load,false);
		window.addEventListener('load',pw_load,false);}})();
	</script>
	<!-- End Project Wonderful Ad Box Loader -->

    <div class="clearfix">

		<div id="playgame">

			<div id="playgame_header" class="clearfix">

				<?php 
					$developers_as_string = "";

					foreach($developers as $dev)
					{
						if (empty($developers_as_string))
						{
							$developers_as_string = $dev->name;
						}
						else
						{
							$developers_as_string = $developers_as_string."&".$dev->name;
						}
					}
				?>

				<h2><?='Walkthrough for <span>'.$game->name.'</span>'?><br/><small><?='A game by '.$developers_as_string?></small></h2>
			</div>

			<div class="clearfix" style="width: 980px; text-align: center; margin-bottom: 25px;">
				<div id="flashobject_header">
					<ul>
						<li class="neutral">Share on: </li>

						<li class="twitter"><a href="<?='http://twitter.com/home?status='.urlencode('Playing a cool game! '.$game->name.' - '.current_url())?>" title="Twitter" target="_blank">Twitter</a></li>

						<li class="facebook"><a href="<?='http://www.facebook.com/share.php?u='.urlencode(current_url())?>" title="Share on Facebook" target="_blank">Facebook</a></li>

						<li class="digg"><a href="<?='http://digg.com/submit?phase=2&url='.urlencode(current_url()).'&title='.urlencode($game->name).'&bodytext='.urlencode($game->tagline).'&topic=playable_web_games'?>" title="Share on Digg" target="_blank">Digg</a></li>

						<li class="stumble"><a href="<?='http://www.stumbleupon.com/submit?title='.urlencode($game->name).'&url='.urlencode(current_url())?>" title="Share on StumbleUpon" target="_blank">StumbleUpon</a></li>

						<li class="reddit"><a href="<?='http://www.reddit.com/r/gaming/submit?url='.urlencode(current_url())?>" title="Share on Reddit" target="_blank">Reddit</a></li>
						
						<!-- http://code.google.com/apis/+1button/#target-url -->
						<!-- Place this tag where you want the +1 button to render -->
						<li><g:plusone size="small"></g:plusone></li>

					</ul>
				</div>

				<div id="flashobject">
					<div id="player_wrap">
					   <div id="ytapiplayer">
							You need Flash player 8+ and JavaScript enabled to view this video.
					   </div>
					</div>

					<div style="margin:0 auto; width: 640px; height:120px; text-align: center;" id="test">
						<!-- "previous page" action -->
						<a class="prev browse left"></a>
						 
						<!-- root element for scrollable -->
						<div class="scrollable" id="scrollable">
						 
						  <!-- root element for the items -->
						  <div class="items">						 						 						 
						  </div>
						 
						</div>
						 
						<!-- "next page" action -->
						<a class="next browse right"></a>
					</div>
				</div>
			</div>

			<div id="adcontainer_main" class="clearfix">
				<!-- START CPMStar CODE -->
				<!--<SCRIPT language="Javascript">
				var cpmstar_rnd=Math.round(Math.random()*999999);
				var cpmstar_pid=13162;
				document.writeln("<SCR"+"IPT language='Javascript' src='http://server.cpmstar.com/view.aspx?poolid="+cpmstar_pid+"&script=1&rnd="+cpmstar_rnd+"'></SCR"+"IPT>");
				</SCRIPT>-->
				<!-- END CPMStar CODE -->

				<!-- BEGIN EpicGameAds CODE -->
				<script type="text/javascript">document.write("<iframe src='http://www.epicgameads.com/ads/banneriframe.php?id=77i2MOIakN&t=728x90&channel=0&cb=" + (Math.floor(Math.random()*99999) + new Date().getTime()) + "' style='width:728px;height:90px;' frameborder='0' scrolling='no'></iframe>");</script>
				<!-- END EpicGameAds CODE -->
			</div>

			<div class="clearfix" style="margin-bottom: 10px;">
				<div id="gameinfo">
					<h3>Genres</h3>

					<ul class="gamegenres">
						<?php foreach($genres as $row): ?>
							<li><a href="<?=base_url().'index.php/arcade/browsebygenre/'.$row->genre_id?>" title="<?='Browse by '.$row->genre_name?>"><?=$row->genre_name?></a></li>	
						<?php endforeach ?>
					</ul>

					<h3>Tags</h3>

					<ul class="gametags">
						<?php foreach($tags as $row): ?>
							<li><a href="<?=base_url().'index.php/arcade/browsebytag/'.$row->tag_id?>" title="<?='Browse by '.$row->name?>"><?=$row->name?></a></li>	
						<?php endforeach ?>
					</ul>

					<h3>Info Box</h3>

					<div class="infobox">
						<?=parse_smileys($game->help, base_url().'/res/img/smileys').'<br/>'.anchor(base_url().'index.php/arcade/play/'.$game->game_id, 'Click to play the game!', array('title' => 'Play '.$game->name))?>
					</div>

					<div class="fb-comments" data-href="<?=current_url()?>" data-num-posts="5" data-width="600" data-colorscheme="dark">
					</div>					
				</div>

				<div id="adcontainer_play" class="clearfix">
					<h3>Ads</h3>

					<!-- Begin EpicAds Code -->
					<script type="text/javascript">document.write("<iframe src='http://www.epicgameads.com/ads/banneriframe.php?id=77i2MOIakN&t=300x250&channel=0&cb=" + (Math.floor(Math.random()*99999) + new Date().getTime()) + "' style='width:300px;height:250px;' frameborder='0' scrolling='no'></iframe>");</script>
					<!-- End EpicAds Code -->

					<div class="fb-like-box" data-href="http://www.facebook.com/pirongames" data-width="300" data-colorscheme="dark" data-show-faces="true" data-border-color="7f7f7f" data-stream="false" data-header="true" style="background: rgba(0,0,0,0.66); background: url(http://www.pirongames.com/res/img/bkg_alpha066.png) repeat;"></div>
				</div>
			</div>
		</div> <!-- #playgame -->

		<h3>More Games!</h3>

		<div id="featured_others" class="clearfix">
			<?php 
				$index = 0;

				foreach($related_games as $game):

				$id = ($index == 4) ? 'last2' : '';
				$index++;
			?>
				<dl id="<?=$id?>">
					<dt><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>"><img src="<?=base_url().'res/img/icons_normal/'.$game->normal_icon?>" alt="<?=$game->name.' Thumbnail'?>"/></a><?=character_limiter($game->name, 18)?></dt>
					<dd><?=$game->tagline.' '?><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>">&raquo;&nbsp;Play</a></dd>
				</dl>
			<?php endforeach ?>
		</div>
	</div>

	<!-- write divs containing packs of 4 img; horrid mingling of php and js :-& -->
	<!-- thor, god of thunder, please strike down whoever is responsible for inventing php and js. any day now... -->
	<script type="text/javascript">
		var newdiv = $("<div></div>");
		var counter = 0;

		<?php foreach($wt_entries as $entry): ?>
			var img = $("<img></img>");
			img.attr("src", "http://i.ytimg.com/vi/" + "<?=$entry->youtube_id?>" + "/1.jpg");
			img.attr("title", "<?=$entry->info?>");

			if (counter > 3)
			{
				$(".items").append(newdiv);
				var newdiv = $("<div></div>");
				counter = 0;
			}

			newdiv.append(img);
			counter++;
		<?php endforeach ?>		

		$(".items").append(newdiv);
	</script>

	<script>
		$(function() {
		$(".scrollable").scrollable();

		$(".items img[title]").tooltip();

		var params = { allowScriptAccess: "always", allowFullScreen:true, wmode:"opaque" };
		var atts = { id: "myytplayer" };
		swfobject.embedSWF("http://www.youtube.com/v/<?=$wt_entries[0]->youtube_id?>?enablejsapi=1&playerapiid=ytplayer&version=3",
                       "ytapiplayer", "640", "480", "8", null, null, params, atts);

		//grab a youtube id from a (clean, no querystring) url (thanks to http://jquery-howto.blogspot.com/2009/05/jyoutube-jquery-youtube-thumbnail.html)
		function youtubeid(url) {
			//var ytid = url.match("[\\?&]v=([^&#]*)");
			var ytid = url.match("vi/([^&#]*)/1.jpg");
			ytid = ytid[1];
			return ytid;
		}

		function onYouTubePlayerReady(playerId) {
			ytplayer = document.getElementById("myytplayer");
		}

		$(".items img").click(function() {
			// see if same thumb is being clicked
			if ($(this).hasClass("active")) { return; }
			
			ytplayer = document.getElementById("myytplayer");

			if (ytplayer) 
			{
				ytplayer.loadVideoById(youtubeid($(this).attr("src")));
			}			
			
			// activate item
			$(".items img").removeClass("active");
			$(this).addClass("active");

		// when page loads simulate a "click" on the first image
		}).filter(":first").click();
		});	
	</script>

