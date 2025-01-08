<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Router Class
 *
 * Extends CI Router
 *
 * @author 	Original by EllisLab - extension by CleverIgniters
 * @see		http://codeigniter.com
 */

class MY_Router extends CI_Router {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function MY_Router()
	{
		parent::CI_Router();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Validate Routing Request
	 *
	 * @access	public
	 */
	function _validate_request($segments)
	{
		// Check the root folder first
		if (file_exists(APPPATH.'controllers/'.$segments[0].EXT))
		{
			return $segments;
		}

		// Not in the root, but not enough segments
		if (count($segments) < 2)
		{
			//Calling the index function of a controller of the same directory...
			//We'll cheat and just set our segment
			$segments[1] = $segments[0];
		}

		// Does the requested controller exist as a full path including the directory?
		if (file_exists(APPPATH.'controllers/'.$segments[0].'/'.$segments[1].EXT))
		{
			//Set the directory
			$this->set_directory($segments[0]);
			
			//Drop the directory segment
			$segments = array_slice($segments, 1);
			return $segments;
		}
		
		//Ok, that didn't work, let's try duplicating segment 0, maybe it's the same ;).
		if (file_exists(APPPATH.'controllers/'.$segments[0].'/'.$segments[0].EXT))
		{
			//Set the directory
			$this->set_directory($segments[0]);
			
			//We cheated so there's nothing to drop
			return $segments;
		}

		// Can't find the requested controller...go to homepage
		return array('listings', 'index');
	}
}
// END MY_Router class

/* End of file MY_Router.php */
/* Location: ./application/libraries/MY_Router.php */