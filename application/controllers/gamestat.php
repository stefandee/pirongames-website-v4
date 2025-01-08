<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
// http://help.adobe.com/en_US/as3/dev/WSb2ba3b1aad8a27b061afd5d7127074bbf44-8000.html
// http://localhost/pirongames/index.php/gamestat/stat/game_id/1/stat_name/highscore/format/xml
// http://stackoverflow.com/questions/73947/what-is-the-best-way-to-stop-people-hacking-the-php-based-highscore-table-of-a-fl

//function GetUserIP() { var js="function get_userIP(){return java.net.InetAddress.getLocalHost().getHostAddress();}"; var userIPInfo:String=ExternalInterface.call(js).toString(); return userIPInfo; }

/*
<?php
	
	$server   = ''; // MySQL hostname
	$username = ''; // MySQL username
	$password = ''; // MySQL password
	$dbname   = ''; // MySQL db name
	
	
	$db = mysql_connect($server, $username, $password) or die(mysql_error());
	      mysql_select_db($dbname) or die(mysql_error());
	
	$sql = 'SELECT 
	            c.country 
	        FROM 
	            ip2nationCountries c,
	            ip2nation i 
	        WHERE 
	            i.ip < INET_ATON("'.$_SERVER['REMOTE_ADDR'].'") 
	            AND 
	            c.code = i.country 
	        ORDER BY 
	            i.ip DESC 
	        LIMIT 0,1';
	
	list($countryName) = mysql_fetch_row(mysql_query($sql));
	
	// Output full country name
	echo $countryName;
*/				

require APPPATH.'/libraries/REST_Controller.php';

class GameStat extends REST_Controller 
{		
	/**
	 * Constructor
	 *
	 * @access	public
	 */
    function __construct()
    {
		parent::__construct();
				
		// test session for the game submit token
		// $this->load->library('session');

		// Load Necessary files
		$this->load->model('gamelist_model', 'gamelist');
	}

	/*
	function GameStat()
	{
	}
	*/

	function country_get()
	{
		$this->response($this->gamelist->get_country_code($_SERVER['REMOTE_ADDR']), 200);
		// '2001:4860:a005::68'
	}

	/**
	 * Return the game info and a list of stats for the game with specified id
	 *
	 * @access	public
	 */
	function info_get()
	{
        //echo "game id: ".$this->get('game_id')."\n";
		
		if( !$this->get('game_id'))
		{
        	$this->response(NULL, 200);

			return;
		}

		if ( !$this->gamelist->validate_game_id($this->get('game_id')))
		{
        	$this->response(NULL, 200);

			return;
		}

		$this->response(
			array
			(
				'gameinfo' => $this->gamelist->get_game_by_id_simple($this->get('game_id')),
				'stats' => $this->gamelist->get_stats($this->get('game_id')),
			    'submitToken' => $this->session->userdata('submitToken')
		    ), 
		200);
	}

	/**
	 * Returns all stat values for a game, starting from a certain date
	 * if no timestamp is specified, return all stats
	 *
	 * @access	public
	 */
	function leaderboard_get()
	{
        if( !$this->get('game_id') ||
		    !$this->get('stat_name'))
        {
        	$this->response(NULL, 200);

			return;
        }

		$game_id = $this->get('game_id');
		$stat_name = $this->get('stat_name');
		
		// 1970 - the dawn of time :)
		$timestamp = date("Y-m-d H:i:s", 0);

		/*
		if ($this->get('timestamp'))
		{
			$timestamp = date("Y-m-d H:i:s", (int)$this->get('timestamp'));
		}
		*/

		//echo($timestamp);

		$stat = $this->gamelist->validate_stat($game_id, $stat_name);

		if ($stat == NULL)
		{
            $this->response(array('error' => 'game or stat not found'), 200);
		}
		else
		{
			$CI =& get_instance();
			$leaderboard = $this->gamelist->get_leaderboard($game_id, $stat_name, $timestamp, $CI->config->item('max_leaderboard_entries'));

			if (count($leaderboard) > 0)
			{
				$this->response($leaderboard, 200);
			}
			else
			{
				$this->response(array('error' => 'no entries'), 200);
			}
		}

		// TODO: query the database for the game stat after timestamp
		// TODO: return as xml
		// TODO if no game_id or no stat_name, return 404
	}

    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }

	/**
	 * Submit a stat value for a game
	 *
	 * @access	public
	 */
	function submit_post()
	{
		if( !$this->post('game_id') ||
		    !$this->post('player_name') ||
			!$this->post('submitToken'))
		{
        	$this->response(array('error' => 'Parameters are missing.'), 200);

			return;
		}

		$playerName = trim($this->post('player_name'));

		// TODO: bail out if player_name is empty
		if (empty($playerName))
		{
        	$this->response(array('error' => 'Player name is empty.'), 200);

			return;
		}

		$submit_token = $this->post('submitToken');

		if ($submit_token != $this->session->userdata('submitToken'))
		{        	
			//$this->response(array('error' => 'wrong token '.$submit_token. ' expected '.$this->gamelist->submitToken), 200);
			$this->response(array('error' => 'wrong token '.$submit_token), 200);

			return;
		}
		
		$gameId      = $this->post('game_id');
		$playerName  = $this->post('player_name');
		$countryCodeRow = $this->gamelist->get_country_code($_SERVER['REMOTE_ADDR']);

		// private code for country (hardcoded, must find a better way)
		$countryCode = "01";
		
		if ($countryCodeRow)
		{
			$countryCode = $countryCodeRow->code;
		}

		// search for all stat_name and value and submit each one
		for ($i = 0; $i <= 100; $i++) 
		{
			if (!$this->post('stat_name'.$i) ||
				!$this->post('value'.$i))
			{
				//echo "break at " + $i;
				break;
			}

			// TODO: protect from sql injection
			$stat = $this->gamelist->validate_stat($gameId, $this->post('stat_name'.$i));

			if ($stat == NULL)
			{
				//echo "no stat found " + $i;
       			$this->response(array('error' => 'stat not found: '.$this->post('stat_name'.$i)), 200);

				return;
			}

			//echo "request: ".$i;

			$CI =& get_instance();
			$this->gamelist->submit_stat($gameId, $stat->stat_id, $this->post('value'.$i), $playerName, $countryCode, $stat->higher_is_better, $CI->config->item('max_leaderboard_entries'));
		}

		// TODO: obtain the stat_id from the $stat_name

		// everything went well :)
       	$this->response(array('ok' => 'submit OK with token '.$this->session->userdata('submitToken')), 200);
	}
}