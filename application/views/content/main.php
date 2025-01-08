    
    <div class="clearfix">
    			
		<h2>The Games I've Made.</h2>

        <div id="featured_piron" class="clearfix">
			<?php 
				$index = 0;

				foreach($games_featured as $game):

				$id = ($index == 2) ? 'last1' : '';
				$index++;
			?>
				<dl class="featured_piron" id="<?=$id?>">
					<dt><a href="<?='index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>"><img src="<?='res/img/icons_large/'.$game->large_icon?>" alt="<?=$game->name.' Thumbnail'?>"/></a><?=character_limiter($game->name, 18)?></dt>
					<dd><?=$game->tagline.' '?><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>">&raquo;&nbsp;Play</a></dd>
				</dl>
			<?php endforeach ?>

			<!--TODO: -->
			<ul class="<?=($games_featured_count > 3) ? 'gamesnav' : 'hidden'?>">
				<li><?=anchor('arcade/browsegames', 'More Games!')?></li>
			</ul>
		</div>

		<div id="adcontainer_main" class="clearfix">
			<!-- BEGIN FunKlicks.com CODE -->
			<!--<IFRAME SRC="http://www.funklicks.com/work.php?n=12084&size=9" width=728 height=90 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling="no"></IFRAME>-->
			<!-- END FunKlicks.com CODE -->

			<!-- BEGIN EpicGameAds CODE -->
			<script type="text/javascript">document.write("<iframe src='http://www.epicgameads.com/ads/banneriframe.php?id=77i2MOIakN&t=728x90&channel=0&cb=" + (Math.floor(Math.random()*99999) + new Date().getTime()) + "' style='width:728px;height:90px;' frameborder='0' scrolling='no'></iframe>");</script>
			<!-- END EpicGameAds CODE -->

		</div>

		<h2>The Games I've Played.</h2>

        <div id="featured_others" class="clearfix">
			<?php 
				$index = 0;

				foreach($games_other as $game):

				$id = ($index % 5 == 4) ? 'last2' : '';
				$index++;
			?>
				<dl id="<?=$id?>">
					<dt><a href="<?='index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>"><img src="<?='res/img/icons_normal/'.$game->normal_icon?>" alt="<?=$game->name.' Thumbnail'?>"/></a><?=character_limiter($game->name, 18)?></dt>
					<dd><?=$game->tagline.' '?><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>">&raquo;&nbsp;Play</a></dd>
				</dl>
			<?php endforeach ?>

			<ul class="<?=($games_other_count > 10) ? 'gamesnav' : 'hidden'?>">
				<li><?=anchor('arcade/browsegames', 'More Games!')?></li>
			</ul>
		</div>

		<h2>Games by Genre</h2>

        <div id="browsegenre" class="clearfix">
			<ul class="browsegenre">
				<?php foreach($genres_games as $row): ?>
					<li><a href="<?='index.php/arcade/browsebygenre/'.$row->genre_id?>" title="<?='Browse by '.$row->genre_name?>"><span class="<?='genre'.genre_games_class_id($row->game_count/$games_count)?>"><?=$row->genre_name.'('.$row->game_count.')'?></span></a></li>	
				<?php endforeach ?>
			</ul>
		</div>

		<h2>Games by Tags</h2>

        <div id="browsetags" class="clearfix">
			<ul class="browsetags">
				<?php foreach($tags_games as $row): ?>
					<li><a href="<?='index.php/arcade/browsebytag/'.$row->tag_id?>" title="<?='Browse by '.$row->name?>"><span class="<?='tag'.tag_games_class_id($row->game_count/$games_count)?>"><?=$row->name.'('.$row->game_count.')'?></span></a></li>	
				<?php endforeach ?>
			</ul>
		</div>
	</div>