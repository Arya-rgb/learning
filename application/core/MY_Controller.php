<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $class, $method, $is_print, $db, $ndb;
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 36000000000000);
        ini_set('memory_limit', '-1');

        $this->db     = $this->load->database('default', true);
        $this->ndb    = 'default';
        $this->method = $this->router->fetch_method();
        $this->class  = $this->router->fetch_class();

        // $this->load->model('master_model');
    }

}
