<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Validation extends CI_Validation {
			
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function MY_Validation()
	{
		parent::CI_Validation();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set Fields
	 *
	 * This function takes an array of field names as input
	 * and generates class variables with the same name, which will
	 * either be blank or contain the $_POST value corresponding to it
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function set_fields($data = '', $field = '')
	{		
		if ($data == '')
		{
			if (count($this->_fields) == 0)
			{
				return FALSE;
			}
		}
		else
		{
			if ( ! is_array($data))
			{
				$data = array($data => $field);
			}
			
			if (count($data) > 0)
			{
				$this->_fields = $data;
			}
		}
				
		foreach($this->_fields as $key => $val)
		{
			$this->$key = ( ! isset($_POST[$key])) ? '' : $this->prep_for_form($_POST[$key]);
			
			$error = $key.'_error';

			if ( ! isset($this->$error))
			{
				$this->$error = '';
			}
			else if($this->$error != '')
			{
				$this->$error = 'field_error';
			}
		}
		
		// Remove blank errors
		$this->_error_array = array_filter($this->_error_array);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Check Login
	 *
	 * @access	public
	 * @param	string	password, email-field name
	 * @return	bool
	 */
	function check_login()
	{
		$this->_error_messages['check_login'] = '';
		
		if(count($this->_error_array) > 0)
		{
			return FALSE;
		}
		
		$token		= $this->CI->input->post('token');
		$username	= $this->CI->input->post('username');
		$password	= $this->CI->input->post('password');
				
		if ( ! check_token($token, 120))
		{
			// Expired or incorrect token
			$this->_error_array[] = 'Security error - please try again.';					
			return FALSE;
		}
		
		// Try authenticating
		$login = $this->CI->access->login($username, $password);

		if($login === 'BANNED')
		{
			$this->_error_array[] = 'Your account has been suspended.';
			return FALSE;
		}
		else if($login === 'NOT_ACTIVATED')
		{
			$this->_error_array[] = 'Your account is not yet activated.';
			return FALSE;
		}
		else if($login === 'TIMEOUT')
		{
			// Throttled authentication
			$this->_error_array[] = 'Too many attempts.  You can try again in 20 seconds.';
			return FALSE;
		}
		
		if($login)
		{
			// Authentication valid
			return TRUE;
		}
		else
		{
			// Wrong username/password combination
			$this->_error_array[] = 'Credentials do not match.';		
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Username availability
	 *
	 * @access	public
	 * @param	string	username
	 * @return	bool
	 */
	function check_username($username)
	{
		if ($this->CI->access->check_username($username))
		{
			$this->_error_messages['check_username'] = 'This username is already in use.';		
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Email availability
	 *
	 * @access	public
	 * @param	string	email
	 * @return	bool
	 */
	function check_email($email, $old = FALSE)
	{
		if ($email !== $old AND $this->CI->access->check_email($email))
		{
			$this->_error_messages['check_email'] = 'This email address is already in use.';		
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Current Password
	 *
	 * @access	public
	 * @param	string	password
	 * @return	bool
	 */
	function check_password($pass)
	{
		if ($this->CI->access->login($this->CI->user->username, $pass) !== TRUE)
		{
			$this->_error_messages['check_password'] = 'Existing Password Incorrect';		
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if Category Exists
	 *
	 * @access	public
	 * @param	string	category
	 * @return	bool
	 */
	function check_category($new, $old)
	{
		$this->CI->load->model('listings_model', 'listings');
		
		if ($new !== $old && $this->CI->listings->check_category($new) )
		{
			$this->_error_messages['check_category'] = 'Category Already Exists';		
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Required
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function required($str)
	{
		if (trim($str) == '')
		{
			// Add to front of error array, if it doesn't already exist
			if ( ! array_key_exists('required', $this->_error_array))
			{
				$this->_error_messages['required'] = '';
				
				$message = array('required' => 'You must fill in all required fields.');
				$this->_error_array = array_merge($message, $this->_error_array);	
			}
			return FALSE;
		}
		
		return TRUE;
	}
	
}

/* End of file MY_Validation.php */
/* Location: ./application/libraries/MY_Validation.php */