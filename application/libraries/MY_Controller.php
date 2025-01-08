<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 * Extends CI Controller
 *
 * @author 	Original by EllisLab - Extension by CleverIgniters
 * @see		http://codeigniter.com
 */
class MY_Controller extends Controller {
	
	var $user;
	
    function MY_Controller()
	{
		parent::Controller();

		// Get user object
		//$this->user = $this->access->get_user();
		
		//$this->load->helper('confirm');		
    }

} // End MY_Controller


// ------------------------------------------------------------------------


/**
 * MY_Admin Class
 *
 * Extends MY_Controller
 *
 * @author 	CleverIgniters
 */
 /*
class MY_Admin extends MY_Controller
{	
    function MY_Admin()
    {
        parent::MY_Controller();

		// Protect the admin area
		$this->access->restrict('Administrators');
		
		// Default Admin Sidebar
		$this->template->sidebar('member');
		
		// Don't want to cache this content
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");
    }

} // End Admin class
*/


/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */