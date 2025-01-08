    
    <div class="clearfix">
		<h2><?=$browse_title?></h2>

        <div id="featured_others" class="clearfix">
			<?php 
				$index = 0;

				foreach($browse_games as $game):

				$id = (($index % 5) == 4) ? 'last2' : '';
				$index++;
			?>
				<dl id="<?=$id?>">
					<dt><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>"><img src="<?=base_url().'/res/img/icons_normal/'.$game->normal_icon?>" alt="<?=$game->name.' Thumbnail'?>"/></a><?=character_limiter($game->name, 16)?></dt>
					<dd><?=$game->tagline.' '?><a href="<?=base_url().'index.php/arcade/play/'.$game->game_id?>" title="<?='Play '.$game->name?>">&raquo;&nbsp;Play</a></dd>
				</dl>
			<?php endforeach ?>
		</div>

		<div class="rightblock clearfix">
			<?=$pagination?>
		</div>
	</div>