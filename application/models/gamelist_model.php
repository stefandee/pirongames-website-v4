<?php

class Gamelist_Model extends Model
{
	var $games_table 	= 'arcade_games'; 	// Games table
	var $genres_table 	= 'arcade_genres'; 	// Genres table
	var $tags_table 	= 'arcade_tags'; 	// Tags table

	function Gamelist_model()
	{
		parent::Model();

		$this->load->database();
	}

	function get_all_genres()
	{
		$query = $this->db->get($this->genres_table);
		return $query->result();
	}

	function get_genre_by_id($id)
	{				
		$query = $this->db->get_where($this->genres_table, array('genre_id' => $id));

		//echo $id.'  '.$query->num_rows().'<br/>';

		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}

	function get_all_games($limit = FALSE, $offset = FALSE, $published = TRUE)
	{				
		$query = $this->db->query("SELECT * FROM arcade_games ag WHERE ag.published=".$published." ORDER BY ag.added DESC LIMIT ".intval($offset).",".intval($limit));

		return $query->result();
	}

	function get_all_games_count()
	{
		$query = $this->db->get($this->games_table);

		return $query->num_rows();
	}

	function get_game_by_id($id, $published = TRUE)
	{
		$query = $this->db->query("SELECT * FROM arcade_games ag WHERE ag.published=".$published." AND ag.game_id=".$id);

		//$query = $this->db->get_where($this->games_table, array('game_id' => $id));

		return $query->result();
	}

	function get_genres_for_game_id($id)
	{
		$query = $this->db->query("SELECT * FROM arcade_genres ag, arcade_games_genres agg WHERE ag.genre_id = agg.genre_id AND agg.game_id=".$id);

		return $query->result();
	}

	function get_tags_for_game_id($id)
	{
		$query = $this->db->query("SELECT * FROM arcade_tags at, arcade_games_tags agt WHERE at.tag_id = agt.tag_id AND agt.game_id=".$id);

		return $query->result();
	}

	/**
	 * Gets the latest featured games (developer == piron)
	 * Should be get_all_piron_games instead ;)
	 *
	 * @access	public
	 */
	function get_all_featured_games($published = TRUE)
	{
		//$query = $this->db->query("SELECT * FROM arcade_games g, arcade_games_devs gd WHERE g.published=".$published." AND g.game_id = gd.game_id AND gd.dev_id = 1 ORDER BY g.added DESC");

		$query = $this->db->query("SELECT * FROM arcade_games g, arcade_featured_games fg WHERE g.published=".$published." AND g.game_id = fg.game_id");

		/* LIMIT 3 :) */

		return $query->result();		
	}

	function get_all_other_games($published = TRUE)
	{
		//$query = $this->db->query("SELECT g.game_id, g.tagline, g.name, g.normal_icon FROM arcade_games g, arcade_featured_games fg WHERE g.published=".$published." AND fg.game_id != g.game_id GROUP BY g.game_id ORDER BY g.added DESC");

		// wtf O.o
		$query = $this->db->query("SELECT g.game_id, g.tagline, g.name, g.normal_icon FROM arcade_games g LEFT JOIN arcade_featured_games fg ON fg.game_id = g.game_id WHERE fg.game_id IS NULL AND g.published=".$published." ORDER BY g.added DESC");

		// SELECT CarIndex FROM DealerCatalog LEFT JOIN BigCatalog ON DealerCatalog.CarIndex=BigCatalog.CarIndex WHERE BigCatalog.CarIndex IS NULL
		
		// eventually prohibit also displaying the featured/piron games?
		// arcade_games_devs gd, gd.dev_id != 1

		/* LIMIT 5 :) */

		return $query->result();		
	}

	function get_tags_games($published = TRUE)
	{
		$query = $this->db->query("SELECT at.tag_id, at.name, count(*) AS game_count FROM (arcade_tags at, arcade_games ag) JOIN arcade_games_tags agt ON at.tag_id = agt.tag_id WHERE agt.game_id = ag.game_id AND ag.published=".$published." GROUP BY at.tag_id ORDER BY game_count DESC LIMIT 50");		

		/*
		$query = $this->db->query("SELECT arcade_tags.tag_id, arcade_tags.name, count(*) AS game_count FROM arcade_tags JOIN arcade_games_tags ON arcade_tags.tag_id = arcade_games_tags.tag_id GROUP BY arcade_tags.tag_id ORDER BY game_count DESC LIMIT 50");
		*/

		return $query->result();		
	}

	function get_genres_games($published = TRUE)
	{
		$query = $this->db->query("SELECT arcade_genres.genre_id, arcade_genres.genre_name, count(*) AS game_count FROM (arcade_genres, arcade_games) JOIN arcade_games_genres ON arcade_genres.genre_id = arcade_games_genres.genre_id WHERE arcade_games.game_id = arcade_games_genres.game_id AND arcade_games.published=".$published." GROUP BY arcade_genres.genre_id ORDER BY arcade_genres.genre_name ASC");

		return $query->result();		
	}

	function get_games_by_genre($genre_id, $limit = FALSE, $offset = FALSE, $published = TRUE)
	{		
		/*echo "SELECT * FROM arcade_games g, arcade_games_genres gg WHERE gg.game_id = g.game_id AND gg.genre_id = ".$genre_id." LIMIT ".intval($offset).",".intval($limit).'<br/>';*/
		
		$query = $this->db->query("SELECT * FROM arcade_games g, arcade_games_genres gg WHERE g.published=".$published." AND gg.game_id = g.game_id AND gg.genre_id = ".$genre_id." LIMIT ".intval($offset).",".intval($limit));

		return $query->result();
	}

	function get_games_by_genre_count($genre_id, $published = TRUE)
	{
		$query = $this->db->query("SELECT * FROM arcade_games g, arcade_games_genres gg WHERE g.published=".$published." AND gg.game_id = g.game_id AND gg.genre_id = ".$genre_id);

		return $query->num_rows();
	}

	function get_games_by_tag($tag_id, $limit = FALSE, $offset = FALSE, $published = TRUE)
	{		
		/*echo "SELECT * FROM arcade_games g, arcade_games_genres gg WHERE gg.game_id = g.game_id AND gg.genre_id = ".$genre_id." LIMIT ".intval($offset).",".intval($limit).'<br/>';*/
		
		$query = $this->db->query("SELECT * FROM arcade_games g, arcade_games_tags gt WHERE g.published=".$published." AND gt.game_id = g.game_id AND gt.tag_id = ".$tag_id." LIMIT ".intval($offset).",".intval($limit));

		return $query->result();
	}

	function get_games_by_tag_count($tag_id, $published = TRUE)
	{
		$query = $this->db->query("SELECT * FROM arcade_games g, arcade_games_tags gt WHERE g.published=".$published." AND gt.game_id = g.game_id AND gt.tag_id = ".$tag_id);

		return $query->num_rows();
	}

	function get_tag_by_id($id)
	{				
		$query = $this->db->get_where($this->tags_table, array('tag_id' => $id));

		//echo $id.'  '.$query->num_rows().'<br/>';

		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}

	function get_devs_for_game_id($id)
	{
		$query = $this->db->query("SELECT * FROM arcade_developers ad, arcade_games_devs agd WHERE agd.game_id = ".$id." AND ad.dev_id = agd.dev_id");

		return $query->result();
	}

	/*
	function get_genres_for_game_id($game_id)
	{
		$query = $this->db->query("SELECT agg.genre_id FROM arcade_games_genres agg, arcade_games ag WHERE ag.game_id = ".$game_id." AND ag.game_id = agg.game_id");

		return $query->result();
	}

	function get_tags_for_game_id($game_id)
	{
		$query = $this->db->query("SELECT agt.tag_id FROM arcade_games_tags agt, arcade_games ag WHERE ag.game_id = ".$game_id." AND ag.game_id = agt.game_id");

		return $query->result();
	}
	*/

	function get_related_games($game_id, $published = TRUE)
	{
		/*
		$limit = 5;

		$query = $this->db->query("SELECT arcade_games.game_id, arcade_games.name, arcade_games.normal_icon, arcade_games.large_icon, arcade_games.tagline FROM arcade_games WHERE arcade_games.game_id != ".$game_id." AND arcade_games.published=".$published);

		$result = $query->result();
		
		shuffle($result);

		return array_slice($result, 0, 5);
		*/

		$genres = $this->get_genres_for_game_id($game_id);

		$composite_query_string = "";

		foreach($genres as $genre)
		{
			if (empty($composite_query_string))
			{
				$composite_query_string = "agg.genre_id=".$genre->genre_id;
			}
			else
			{
				$composite_query_string = $composite_query_string." OR agg.genre_id=".$genre->genre_id;
			}
		}

		$tags = $this->get_tags_for_game_id($game_id);

		//$tags_query_string = "";

		foreach($tags as $tag)
		{
			if (empty($composite_query_string))
			{
				$composite_query_string = "agt.tag_id=".$tag->tag_id;
			}
			else
			{
				$composite_query_string = $composite_query_string." OR agt.tag_id=".$tag->tag_id;
			}
		}

		$query_string = "SELECT ag.game_id, ag.name, ag.normal_icon, ag.large_icon, ag.tagline FROM (arcade_games ag, arcade_games_genres agg, arcade_games_tags agt) WHERE ag.game_id != ".$game_id." AND ag.published = ".$published." AND ag.game_id = agg.game_id AND ag.game_id = agt.game_id";
		
		if (!empty($composite_query_string))
		{
			$query_string = $query_string." AND (".$composite_query_string.")";
		}

		$query_string = $query_string." GROUP BY ag.game_id";
		
		//echo 'query string: '.$query_string.'<br/>';

		$query = $this->db->query($query_string);

		$result = $query->result(); 

		// pick 5 random game entries
		$random_indices = array_rand($result, 5);

		$rand_result = array();

		foreach($random_indices as $index)
		{
			$rand_result[$index] = $result[$index];
		}

		return $rand_result;
		//return array_rand($result, 5);
	}


	function get_shared_games($published = TRUE)
	{		
		$query = $this->db->query("SELECT * FROM arcade_games ag WHERE ag.published=".$published." AND ag.shared_url IS NOT NULL");

		return $query->result();
	}
	// --------------------------------------------------------------------

	/**
	 * Get newest games
	 *
	 * @access	public
	 */
	function get_new_games($limit = '10', $published = TRUE)
	{
		$this->db->where('published', $published);
		$this->db->limit($limit);
		$this->db->order_by('added', 'desc');
		
		$query = $this->db->get($this->games_table);
		return $query->result();
	}	
	// --------------------------------------------------------------------

	/**
	 * Increase the play count of a game by 1
	 *
	 * @access	public
	 */
	function increase_play_count($id)
	{
		$query = $this->db->query("UPDATE arcade_games SET play_count = play_count + 1 WHERE game_id=".$id);

		//return $query->result();
	}

	function validate_game_id($id, $published = TRUE)
	{
		$query = $this->db->query("SELECT * FROM arcade_games ag WHERE ag.published=".$published." AND ag.game_id=".$id);

		//$query = $this->db->get_where($this->games_table, array('game_id' => $id));

		return $query->num_rows() == 1;
	}

	function validate_stat($game_id, $stat_name)
	{
		$query = $this->db->query("SELECT * FROM arcade_stats s WHERE s.game_id=".$game_id." AND s.enabled=1 AND s.stat_name=".$this->db->escape($stat_name));

		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}

	function get_stats($game_id)
	{
		$query = $this->db->query("SELECT s.stat_id,s.stat_name,s.higher_is_better,s.display_name FROM arcade_stats s, arcade_games g WHERE s.game_id=".$game_id." AND g.game_id=".$game_id." AND g.published=1 AND s.enabled=1");

		return $query->result();
	}

	function get_leaderboard($game_id, $stat_name, $timestamp, $higher_is_better, $limit = '100')
	{
		$query = $this->db->query("SELECT gs.player_name, gs.value, gs.timestamp, gs.code FROM arcade_leaderboard gs, arcade_stats s WHERE gs.game_id=".$game_id." AND gs.stat_id=s.stat_id AND s.enabled=1 AND s.stat_name='".$stat_name."' AND gs.timestamp > '".$timestamp."' ORDER BY gs.value ".($higher_is_better ? "DESC" : "ASC")." LIMIT ".$limit);

		return $query->result();
	}

	// http://www.nott.org/blog/ip-2-country.html
	function get_country_code($ip)
	{
		$query = $this->db->query('SELECT 
	            c.code, c.iso_code_2, c.country
	        FROM 
	            ip2nationcountries c,
	            ip2nation i 
	        WHERE 
	            i.ip < INET_ATON("'.$ip.'") 
	            AND 
	            c.code = i.country 
	        ORDER BY 
	            i.ip DESC 
	        LIMIT 0,1');

		return $query->row();
	}

	function get_game_by_id_simple($id, $published = TRUE)
	{
		$query = $this->db->query("SELECT ag.name, ag.tagline FROM arcade_games ag WHERE ag.published=".$published." AND ag.game_id=".$id);

		//$query = $this->db->get_where($this->games_table, array('game_id' => $id));

		return $query->result();
	}

	function submit_stat($game_id, $stat_id, $value, $player_name, $country_code, $higher_is_better, $maxEntries)
	{
		//echo "info: ".$game_id." - ".$stat_id." - ".$higher_is_better."<br/>";
		
		$queryCount = $this->db->query("SELECT count(*) AS scoreCount FROM arcade_leaderboard gs WHERE gs.game_id =".$game_id." AND gs.stat_id = ".$stat_id);			

		$queryCountResult = $queryCount->row();

		//echo "scores count: ".$queryCountResult->scoreCount."<br/>"; 

		// TODO: transfer '100' to the config file
		if ($queryCountResult->scoreCount >= $maxEntries)
		{
			// TODO: check case when there are multiple scores with min/max values
			$queryMinMax = $this->db->query("SELECT gs.idx, gs.value FROM arcade_leaderboard gs WHERE gs.value = (SELECT ".($higher_is_better ? "MIN" : "MAX")."(gs2.value) FROM arcade_leaderboard gs2 WHERE gs2.game_id =".$game_id." AND gs2.stat_id = ".$stat_id.") AND "." gs.game_id =".$game_id." AND gs.stat_id = ".$stat_id);

			$queryMinMaxResult = $queryMinMax->row();

			$idx = $queryMinMaxResult->idx;
			$valueTable = $queryMinMaxResult->value;

			//echo "info for min/max game: ".$idx." -- ".$valueTable." -- ".$queryMinMax->num_rows()."<br/>";

			// value to add is outside 
			if ($value < $valueTable && $higher_is_better ||
				$value < $valueTable && !$higher_is_better)
			{
				return FALSE;
			}

			// remove the min value
			$queryDelete = $this->db->query("DELETE FROM arcade_leaderboard WHERE idx=".$idx);
		}
		
		$query = $this->db->query("INSERT INTO arcade_leaderboard (game_id, stat_id, player_name, code, value, timestamp) VALUES (".$game_id.",".$stat_id.",".$this->db->escape($player_name).",'".$country_code."',".$value.","."NOW()".")");

		return TRUE;
	}

	// returns a list of walkthroughs given a game id
	function get_wt_entries($game_id, $published = TRUE)
	{		
		$query = $this->db->query("SELECT * FROM arcade_wt wt, arcade_games_wt gw WHERE wt.id = gw.wt_id AND gw.game_id = ".$game_id." ORDER BY gw.id");

		return $query->result();
	}
}

/* End of file gamelist_model.php */
/* Location: ./application/models/gamelist_model.php */