<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index($page = null)
  {
    $this->load->model('Contents_model');

    $data['siteTitle']    = "CodeIgniter Bootshop";
    $data['title']      = $data['siteTitle'] . ' - Contents';
    $data['header'] = 'Contents';
    $data['controller'] = 'Contents';

    $data['links'] = $this->Contents_model->get_links();
    
    $this->load->view('header', $data);
    $this->load->view('contents/contents_view', $data);
    $this->load->view('footer', $data);
  }

}