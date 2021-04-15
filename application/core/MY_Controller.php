<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $db;
    var $template_data = array();
    public function __construct()
    {
        parent::__construct();

        $this->db = $this->load->database('default', true);
        $this->load->model('master_model');
    }

    public function load_template($template = '', $view = '', $view_data = array())
    {
        !empty($view_data) ? $this->set('content', $this->load->view($view, $view_data, TRUE)) : $this->set('content', $this->load->view($view, '', TRUE));
        $this->set('logout', base_url('login/logout'));
        $this->set('users', base_url('users'));
        $this->set('animasi', base_url('animasi'));
        return $this->load->view($template, $this->template_data);
    }

    function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
}
