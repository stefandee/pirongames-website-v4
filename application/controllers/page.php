<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Page()
	{
		parent::MY_Controller();
		
		// Load required files
		$this->load->model('pages_model' , 'pages');
		$this->load->model('misc_model', 'misc');

		// Set meta tags for the whole controller (Left here as an example)
		// If you put this in a method, it will replace metas for that method only
		// If you remove this lines below, the script will fetch the default metas that are in /application/config/template.php
		$metas = array(
						'title' 			=> "About",
						'meta_description' 	=> "Piron Games - This is Hardcore!",
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
	 * Initial Method
	 *
	 * @access	public
	 */
	function index()
	{
		$this->show();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the page passed as uri segment
	 *
	 * @access	public
	 */	
	function show($url = FALSE)
	{
		// If no URL was set, we set a default one to prevent errors
		if( ! $url)
		{
			$url = 'home';
		}		
				
		if( ! $data['page'] = $this->pages->get($url))
		{
			show_404();
		}

		// Set page meta tags
		$metas = array(
						'title' 			=> $data['page']->title,
						'meta_description' 	=> $data['page']->meta_description,
						'meta_keywords' 	=> $data['page']->meta_keywords
						);
		
		$this->template->metas($metas);
		
		$this->template->display('page', $data);
	}
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */