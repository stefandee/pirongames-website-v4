<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RSS Class
 *
 * @author		Derek Allard - modified to work with CI-Directory
 * @link		http://www.derekallard.com/blog/post/building-an-rss-feed-in-code-igniter/
 */

class Feed extends MY_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Feed()
	{
		parent::MY_Controller();
		
		$this->load->model('gamelist_model', 'gamelist');
		$this->load->helper('xml');
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Default Controller Function
	 *
	 * @access	public
	 */
	function index()
	{
		$this->show_feed();
	}
	
	// --------------------------------------------------------------------
    
	/**
	 * Show the feed
	 *
	 * @access	public
	 */
	function show_feed()
	{		
		// Set common config
		$data['charset'] 			= $this->config->item('charset');		
		$data['feed_url'] 			= base_url();		
		$data['page_language'] 		= $this->config->item('feed_language');
		$data['creator_email'] 		= $this->config->item('feed_email');
		
		$data['feed_name'] 			= $this->config->item('all_feed_name');
		$data['page_description'] 	= $this->config->item('all_feed_description');
		
		// Get new games
		$data['games'] 				= $this->gamelist->get_new_games($this->config->item('feed_num'));
		
		// Output the feed
		$this->output->set_header("Content-Type: application/xml");
		$this->load->view('rss', $data);
	}

}

/* End of file feed.php */
/* Location: ./application/controllers/feed.php */