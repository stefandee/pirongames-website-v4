	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>    

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

				<h2><?='Playing <span>'.$game->name.'</span>'?><br/><small><?='by '.$developers_as_string?></small></h2>
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
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?=$game->width?>" height="<?=$game->height?>">
						<param name="movie" value="<?=base_url().'res/swf/'.$game->swf?>" />
						<param name="allowScriptAccess" value="always"/>
						<param name="allowNetworking" value="all"/>
						<param name="quality" value="high"/>
						<param name="scale" value="noscale"/>
						<!--[if !IE]>-->
						<object type="application/x-shockwave-flash" data="<?=base_url().'res/swf/'.$game->swf?>" width="<?=$game->width?>" height="<?=$game->height?>" allowScriptAccess="always" allowNetworking="all">
						<!--<![endif]-->
						<div>
							<h1>Get Flash Player then play this game!</h1>
							<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
						</div>
						<!--[if !IE]>-->
						</object>
						<!--<![endif]-->
					</object>
				</div>
			</div>

			<div id="adcontainer_main" class="clearfix">
				<!-- BEGIN CPMStar CODE -->
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
						<?=parse_smileys($game->help, base_url().'/res/img/smileys').'<br/>'.(isset($game->guide_url) ? anchor($game->guide_url, 'Click for the walkthrough!', array('title' => 'Visit Walkthrough for '.$game->name)) : '')?>
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