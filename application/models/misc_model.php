<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Misc_model extends Model
{
	var $link_exchange_table = 'arcade_link_exchange';

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Misc_model()
	{
		parent::Model();
	}

	// --------------------------------------------------------------------

	function get_all_link_exchange_links($limit = FALSE)
	{				
		$query = $this->db->query("SELECT * FROM arcade_link_exchange ale LIMIT ".intval($limit));

		return $query->result();
	}
}

// END pages_model.php
/* Location: ./application/models/pages_model.php */