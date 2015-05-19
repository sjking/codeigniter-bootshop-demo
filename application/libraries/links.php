<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/* manage a list of links
 * @author Steve King
 */
class Links 
{
	private $CI;
	private $links; // array of Link objects
	const NUM_FIELDS = 3;

	function __construct() 
	{
		$this->links = array();
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
	}

	/* read in a file of links, the file is a csv file separated by ';':
	 * 		Name;Description;Link
	 * example:
	 * 		Vegetables;Manage your vegetables;www.example.com/vegetables
	 */
	function read($file)
	{
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle))) {
				$num = count($data);
				if ($num != self::NUM_FIELDS) {
					continue;
				}
				$link = new Link($data[0], $data[1], $data[2]);
				$this->links[] = $link;
			}
		}
	}

	function sort()
	{
		function cmp($a, $b)
		{
			$x = strtolower($a->name());
			$y = strtolower($b->name());
		    return strcmp($x, $y);
		}

		usort($this->links, 'cmp');
	}

	function get_links() 
	{
		return $this->links;
	}

}

class Link
{
	private $name;
	private $desc;
	private $link;

	function __construct($name, $description, $link)
	{
		$this->name = $name;
		$this->desc = $description;
		$this->link = $link;
	}

	public function name()
	{
		return $this->name;
	}

	public function desc()
	{
		return $this->desc;
	}

	public function link()
	{
		return base_url($this->link);
	}
}