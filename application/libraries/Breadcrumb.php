<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Breadcrumb Class
 *
 * This class manages the breadcrumb object
 *
 * @package		Breadcrumb
 * @version		1.0
 * @author 		Richard Davey <info@richarddavey.com>
 * @copyright 	Copyright (c) 2011, Richard Davey
 * @link		https://github.com/richarddavey/codeigniter-breadcrumb
 */
class Breadcrumb {
	
	/**
	 * Breadcrumbs stack
	 *
     */
	private $breadcrumbs	= array();
	
	/**
	 * Options
	 *
	 */
	private $_divider 		= '';
	private $_li_open 		= '<li>';
	private $_li_close 		= '</li>';
	private $_tag_open 		= '<ul class="breadcrumbs">';
	private $_tag_close 	= '</ul>';
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
		
		log_message('debug', "Breadcrumb Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->{'_' . $key}))
				{
					$this->{'_' . $key} = $val;
				}
			}
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Append crumb to stack
	 *
	 * @access	public
	 * @param	string $title
	 * @param	string $href
	 * @return	void
	 */		
	function append_crumb($title, $href)
	{
		// no title or href provided
		if (!$title OR !$href) return;
		
		// add to end
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Prepend crumb to stack
	 *
	 * @access	public
	 * @param	string $title
	 * @param	string $href
	 * @return	void
	 */		
	function prepend_crumb($title, $href)
	{
		// no title or href provided
		if (!$title OR !$href) return;
		
		// add to start
		array_unshift($this->breadcrumbs, array('title' => $title, 'href' => $href));
	}
	
	// --------------------------------------------------------------------

	/**
	 * Generate breadcrumb
	 *
	 * @access	public
	 * @return	string
	 */		
	function output()
	{
		// breadcrumb found
		if ($this->breadcrumbs) {
		
			// set output variable
			$output = $this->_tag_open;
			
			// add html to output
			foreach ($this->breadcrumbs as $key => $crumb) {
				
				// add divider
				if ($key) $output .= $this->_divider;
				
				// if last element
				$an=array_keys($this->breadcrumbs);
				if (end($an) == $key) {
					$output .= $this->_li_open . ($crumb['title']) . $this->_li_close;
					
				// else add link and divider
				} else {
					$output .= $this->_li_open.'<a href="' . $crumb['href'] . '" class="active">' . ($crumb['title']) . '</a>'.$this->_li_close;
				}
			}
			
			// return html
			return $output . $this->_tag_close . PHP_EOL;
		}
		
		// return blank string
		return '';
	}

}
// END Breadcrumb Class

/* End of file Breadcrumb.php */
/* Location: ./application/libraries/Breadcrumb.php */