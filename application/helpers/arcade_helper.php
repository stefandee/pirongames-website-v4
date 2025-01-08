<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Returns a class name for genres and games; usage is (how many games are of a certain genre) / (all games count)
 *
 * @access	public
 * @param	float
 * @return	integer	class id (will be added to an atom to form the class name)
 *
 */
function genre_games_class_id($usage)
{
	// there are 6 classes
	$temp = (integer)(100 / 6);

	return (integer)((100 * $usage) / $temp);
}

/*
 * Returns a class name for tags and games; usage is (how many games are of a certain tags) / (all games count)
 *
 * @access	public
 * @param	float
 * @return	integer	class id (will be added to an atom to form the class name)
 *
 */
function tag_games_class_id($usage)
{
	// there are 6 classes
	$temp = (integer)(100 / 6);

	return (integer)((100 * $usage) / $temp);
}

/* End of file arcade_helper.php */
/* Location: ./application/helpers/arcade_helper.php */