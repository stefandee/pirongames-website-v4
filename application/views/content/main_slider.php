    
    <div class="clearfix">
    			
		<h2>The Games I've Made.</h2>

		<div id="featured_piron" class="clearfix">

			<div id="slider">
				<?php foreach($games_featured as $game):?>
					<a style="display:none;" href="<?='index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>"><img src="<?=base_url().'res/img/icons_large/'.$game->large_icon?>" alt="<?=$game->tagline?>" title="<?=$game->name.'<br/>'.$game->tagline?>"/></a>
				<?php endforeach ?>
			</div>

			<div id="adbox" class="clearfix">
				<div style="display:block;">
					<div class="fb-like-box" data-href="http://www.facebook.com/pirongames" data-width="300" data-height="60" data-colorscheme="dark" data-show-faces="false" data-stream="false" data-header="false"></div>
				</div>
				<div style="display:block;margin-top:10px;">
					<!-- BEGIN FunKlicks.com CODE -->
					<IFRAME SRC="http://www.funklicks.com/work.php?n=12084&size=28" width=300 height=250 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling="no"></IFRAME>
					<!-- END FunKlicks.com CODE -->
				</div>
			</div>

		</div>

        <!--
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

			<ul class="<?=($games_featured_count > 3) ? 'gamesnav' : 'hidden'?>">
				<li><?=anchor('arcade/browsegames', 'More Games!')?></li>
			</ul>
		</div>
		-->

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

		<h2>Play by Genre</h2>

        <div id="browsegenre" class="clearfix">
			<ul class="browsegenre">
				<?php foreach($genres_games as $row): ?>
					<li><a href="<?='index.php/arcade/browsebygenre/'.$row->genre_id?>" title="<?='Play '.$row->genre_name.' games'?>"><span class="<?='genre'.genre_games_class_id($row->game_count/$games_count)?>"><?=$row->genre_name.'('.$row->game_count.')'?></span></a></li>	
				<?php endforeach ?>
			</ul>
		</div>

		<h2>Play by Tags</h2>

        <div id="browsetags" class="clearfix">
			<ul class="browsetags">
				<?php foreach($tags_games as $row): ?>
					<li><a href="<?='index.php/arcade/browsebytag/'.$row->tag_id?>" title="<?='Play '.$row->name.' games'?>"><span class="<?='tag'.tag_games_class_id($row->game_count/$games_count)?>"><?=$row->name.'('.$row->game_count.')'?></span></a></li>	
				<?php endforeach ?>
			</ul>
		</div>
	</div>
