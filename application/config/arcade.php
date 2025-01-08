<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site settings
|--------------------------------------------------------------------------
|
| Global site settings
|
*/

$config['site_name'] 	        = 'Piron Games';
$config['site_email'] 	        = 'karg@pirongames.com'; // Global site email
$config['featured_games_count'] = 3;
$config['other_games_count']    = 10;
$config['tags_count']           = 25;
$config['max_leaderboard_entries'] = 100; // max count of entries allowed for a stat leaderboard

/*
|--------------------------------------------------------------------------
| Default Meta tags
|--------------------------------------------------------------------------
|
| Set the default meta tags site wide
|
*/

$config['default_title'] 		= "Default application title";
$config['default_description'] 	= "Default application description";
$config['default_keywords'] 	= "Default application keywords";


/*
|--------------------------------------------------------------------------
| Feed options
|--------------------------------------------------------------------------
|
| Define the RSS feed options
|
*/

// Common feed config
$config['feed_num'] 			= 10; // How many entries to get
$config['feed_language'] 		= 'en-us';
$config['feed_email'] 			= $config['site_email'];

// All listings feed
$config['all_feed_name'] 		= 'Piron Games';
$config['all_feed_description'] = 'Latest games on Piron';

// Categories listings feed
/* $config['cat_feed_name'] 		= 'Linkster categories feed';


/*
|--------------------------------------------------------------------------
| Errors delimiters
|--------------------------------------------------------------------------
|
| Define the error delimiters
|
*/

$config['err_open'] = '<p class="error">';
$config['err_close'] = '</p>';

/* End of file linkster.php */
/* Location: ./application/config/linkster.php */