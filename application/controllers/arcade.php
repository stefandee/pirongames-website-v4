<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Arcade extends MY_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Arcade()
	{
		parent::MY_Controller();
				
		// Load Necessary files
		$this->load->model('gamelist_model', 'gamelist');
		$this->load->model('misc_model', 'misc');
		$this->load->library('pagination');
		$this->load->helper('text');

		// test session for the game submit token
		// $this->load->library('session');

		//$this->load->helper('arcade');
		
		// Set meta tags for the whole controller (Left here as an example)
		// If you put this in a method, it will replace metas for that method only
		// If you remove this lines below, the script will fetch the default metas that are in /application/config/template.php
		// @TODO: Put this kind of explaination in the user guide
		$metas = array(
						'title' 			=> "This Is Hardcore",
						'meta_description' 	=> "Indie game developer",
						'meta_keywords' 	=> "flash,play games,free online games,casual games,arcade",
						'fb_title'          => "Piron Games",
						'fb_description'    => "This is Hardcore!",
						'fb_image'          => base_url()."res/img/piron_logo.png"
						);
		
		$this->template->metas($metas);		

		$CI =& get_instance();
		// TODO: get the hardlinks list from the database and store it for the template to display
		$data['link_exchange_links'] = $this->misc->get_all_link_exchange_links(10);
		$CI->load->vars($data);
	}

	// --------------------------------------------------------------------

	/**
	 * Init the submit tokens
	 *
	 * @access	private
	 */
    private function initSubmitToken()
    {
		// init the submit tokens
		$maxSubmitToken = 219048894;
		$submitToken = rand(0, $maxSubmitToken);
		$controlToken = $maxSubmitToken - $submitToken;

		$this->session->set_userdata('submitToken', $submitToken);
		$this->session->set_userdata('controlToken', $controlToken);
		$this->session->set_userdata('maxSubmitToken', $maxSubmitToken);
    }

	// --------------------------------------------------------------------
	
	/**
	 * Default Controller Function
	 *
	 * @access	public
	 */
    function index()
    {
        $this->browse();
    }

	// --------------------------------------------------------------------
	
	/**
	 * Display the main page: latest Piron Games, latest all games, all tags, all genres
	 *
	 * @access	public
	 */
	function browse()
	{		
		$CI =& get_instance();

		$data['games_count'] = $this->gamelist->get_all_games_count();
		
		$games_featured = $this->gamelist->get_all_featured_games();
		
		$data['games_featured_count'] = count($games_featured);
		$data['games_featured'] = array_slice($games_featured, 0, $CI->config->item('featured_games_count'));

		$games_other = $this->gamelist->get_all_other_games();
		
		$data['games_other_count'] = count($games_other);
		$data['games_other'] = array_slice($games_other, 0, $CI->config->item('other_games_count'));

		
		$genres_games = $this->gamelist->get_genres_games();

		$data['genres_games'] = $genres_games;
		$data['genres_games_count'] = count($genres_games);

		$tags_games = $this->gamelist->get_tags_games();

		$data['tags_games'] = array_slice($tags_games, 0, $CI->config->item('tags_count'));
		$data['tags_games_count'] = count($tags_games);

		$this->template->display('content/main', $data);
	}

	/**
	 * Displays the "play" game page; if the game_id is invalid, redirect to the main page
	 *
	 * @access	public
	 */
	function play($game_id)
	{
		//$this->gamelist->submit_stat(1, 1, 253456, "player_one", "ro", TRUE);
		
		$games_by_id = $this->gamelist->get_game_by_id($game_id);

		// it is possible to access a game with a wrong id
		if (count($games_by_id) == 0)
		{
			redirect();
		}

		// submit token is unique for each game session
		$this->initSubmitToken();

		// update the play count
		$this->gamelist->increase_play_count($game_id);

		$data['game']	    = $games_by_id[0];
		$data['developers'] = $this->gamelist->get_devs_for_game_id($game_id);
		$data['genres']		= $this->gamelist->get_genres_for_game_id($game_id);
		$data['tags']		= $this->gamelist->get_tags_for_game_id($game_id);
		$data['related_games'] = $this->gamelist->get_related_games($game_id);

		$keywords = "free flash game,casual game";

		foreach($data['genres'] as $genre)
		{
			$keywords = $keywords.','.$genre->genre_name;
		}

		foreach($data['tags'] as $tag)
		{
			$keywords = $keywords.','.$tag->name;
		}
		
		$metas = array(	'title' 			=> "Play ".$data['game']->name,
						'meta_description' 	=> $data['game']->tagline,
						'meta_keywords' 	=> $keywords,

						// facebook sharing related
						'fb_title'          => $data['game']->name,
						'fb_description'    => $data['game']->tagline,
						'fb_image'          => base_url()."res/img/icons_normal/".$data['game']->normal_icon
		);

		$this->template->metas($metas);		

		$this->template->display('content/play', $data);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Displays the walkthrough for a game; if the game_id is invalid or the game has no walkthrough, redirect to the main page
	 *
	 * @access	public
	 */
	function walkthrough($game_id)
	{
		//$this->gamelist->submit_stat(1, 1, 253456, "player_one", "ro", TRUE);
		
		$games_by_id = $this->gamelist->get_game_by_id($game_id);

		// it is possible to access a game with a wrong id
		if (count($games_by_id) == 0)
		{
			redirect();
		}

		$data['game']			= $games_by_id[0];
		$data['genres']			= $this->gamelist->get_genres_for_game_id($game_id);
		$data['tags']			= $this->gamelist->get_tags_for_game_id($game_id);
		$data['related_games']	= $this->gamelist->get_related_games($game_id);
		$data['wt_entries']		= $this->gamelist->get_wt_entries($game_id);
		$data['developers'] = $this->gamelist->get_devs_for_game_id($game_id);

		$keywords = "walkthrough,game guide,free flash game,casual game";

		foreach($data['genres'] as $genre)
		{
			$keywords = $keywords.','.$genre->genre_name;
		}

		foreach($data['tags'] as $tag)
		{
			$keywords = $keywords.','.$tag->name;
		}
		
		$metas = array(	'title' 			=> "Walkthrough for ".$data['game']->name,
						'meta_description' 	=> $data['game']->tagline,
						'meta_keywords' 	=> $keywords,

						// facebook sharing related
						'fb_title'          => "Walkthrough for ".$data['game']->name,
						'fb_description'    => $data['game']->tagline,
						'fb_image'          => base_url()."res/img/icons_normal/".$data['game']->normal_icon
		);

		$this->template->metas($metas);		

		$this->template->display('content/walkthrough', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the games belonging to a certain genre
	 *
	 * @access	public
	 */
	function browsebygenre($genre_id = FALSE)
	{		
		$per_page = 15;
		
		$results = $this->gamelist->get_games_by_genre(intval($genre_id), $per_page, $this->uri->segment(4));

		if (count($results) == 0)
		{
			  // wrong genre_id
			  redirect();
		}
		else
		{
			// Set pagination
			$config['base_url'] 	= site_url('arcade/browsebygenre/'.$genre_id);
			$config['total_rows'] 	= $this->gamelist->get_games_by_genre_count(intval($genre_id));
			$config['per_page'] 	= $per_page;
			$this->pagination->initialize($config);
						
			$data['pagination'] 	= $this->pagination->create_links();

			//echo 'setting pagination - '.$data['pagination'].'  '.count($results).'<br/>';			
		}
		
		$genre_data = $this->gamelist->get_genre_by_id($genre_id);

		if (!isset($genre_data))
		{
			redirect();
		}
		
		$data["browse_games"] = $results;
		$data["browse_title"] = 'Browse by '.$genre_data->genre_name.' games.';

		$metas = array(
						'title' 			=> "Browse by Genre",
						'meta_description' 	=> "Browse by Genre",
						'meta_keywords' 	=> "Casual Games, Flash"
						);
		
		$this->template->metas($metas);		

		$this->template->display('content/browsegames', $data);
	}
	
	// --------------------------------------------------------------------


	/**
	 * Display the games tagged with a certain tag
	 *
	 * @access	public
	 */
	function browsebytag($tag_id = FALSE)
	{		
		$per_page = 15;
		
		$results = $this->gamelist->get_games_by_tag(intval($tag_id), $per_page, $this->uri->segment(4));

		if (count($results) == 0)
		{
			  // wrong tag_id
			  redirect();
		}
		else
		{
			// Set pagination
			$config['base_url'] 	= site_url('arcade/browsebytag/'.$tag_id);
			$config['total_rows'] 	= $this->gamelist->get_games_by_tag_count(intval($tag_id));
			$config['per_page'] 	= $per_page;
			$this->pagination->initialize($config);
						
			$data['pagination'] 	= $this->pagination->create_links();

			//echo 'setting pagination - '.$data['pagination'].'  '.count($results).'<br/>';			
		}
		
		$tag_data = $this->gamelist->get_tag_by_id($tag_id);

		if (!isset($tag_data))
		{
			redirect();
		}
		
		$data["browse_games"] = $results;
		$data["browse_title"] = 'Browse by "'.$tag_data->name.'" games.';

		$metas = array(
						'title' 			=> "Browse by Tag",
						'meta_description' 	=> "Browse by Tag",
						'meta_keywords' 	=> "Casual Games, Flash"
						);
		$this->template->metas($metas);		

		$this->template->display('content/browsegames', $data);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Display the shared games (games that have a shared pack url)
	 *
	 * @access	public
	 */
	function browseshared()
	{						
		$metas = array(
						'title' 			=> "Get Free Games for Your Site",
						'meta_description' 	=> "Get Free Games for Your Site",
						'meta_keywords' 	=> "Casual Games, Flash, Dowload, Free Games"
						);
		$this->template->metas($metas);		

		$games = $this->gamelist->get_shared_games();

		if (count($games) == 0)
		{
			redirect();

			return;
		}

		$data['shared_games'] = $games;

		$this->template->display('content/browseshared', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Display all games
	 *
	 * @access	public
	 */
	function browsegames()
	{		
		$per_page = 15;

		$results = $this->gamelist->get_all_games($per_page, $this->uri->segment(3));

		if (count($results) == 0)
		{
			  // something went wrong
			  redirect();

			  return;
		}
		else
		{
			// Set pagination
			$config['base_url'] 	= site_url('arcade/browsegames/');
			$config['total_rows'] 	= $this->gamelist->get_all_games_count();
			$config['per_page'] 	= $per_page;
			$config['uri_segment']  = 3;
			$this->pagination->initialize($config);
						
			$data['pagination'] 	= $this->pagination->create_links();

			//echo 'setting pagination - '.$data['pagination'].'  '.count($results).'<br/>';			
		}
				
		$data["browse_games"] = $results;
		$data["browse_title"] = 'Browse All Games.';

		$metas = array(
						'title' 			=> "Browse All Games",
						'meta_description' 	=> "Browse All Games",
						'meta_keywords' 	=> "Casual Games, Flash"
						);
		$this->template->metas($metas);		

		$this->template->display('content/browsegames', $data);
	}
	
	// --------------------------------------------------------------------
}


/* End of file arcade.php */
/* Location: ./application/controllers/arcade.php */