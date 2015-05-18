<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents_model extends CI_Model
{
  function __construct()
  {
    $this->load->library('Links');
    parent::__construct();
  }

  function get_links()
  {
    $file = dirname(__FILE__) . '/links.csv';
    $this->links->read($file);
    $this->links->sort();

    return $this->links->get_links();
  }
}