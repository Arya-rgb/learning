<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $class, $method, $is_print, $db, $ndb;
    var $template_data = array();
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 36000000000000);
        ini_set('memory_limit', '-1');
        $this->ndb    = 'default';
        $this->method = $this->router->fetch_method();
        $this->class  = $this->router->fetch_class();

        $this->db = $this->load->database('default', true);
        $this->load->model('master_model');
    }

    public function load_template($template = '', $view = '', $view_data = array(), $menu = '', $sub_menu = '')
    {
      !empty($view_data) ? $this->set('content', $this->load->view($view, $view_data, TRUE)) : $this->set('content', $this->load->view($view, '', TRUE));
      $header = $this->master_model->data('*', 'm_menu', ['id_parent' => NULL])->get()->result();
      $this->template_data['list_menu'] = $this->child($header);
      $this->template_data['menu'] = $menu;
      $this->template_data['sub_menu'] = $sub_menu;
      $this->template_data['controller'] = $this;
      $this->set('config_menu', base_url('admin/menu'));
      return $this->load->view($template, $this->template_data);
    }

    function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}

    public function child($header){
      $return = [];
      if (!empty($header)) {
        foreach ($header as $key => $value) {
          $child = $this->master_model->data('*', 'm_menu', ['id_parent' => $value->id])->get()->result();
          $value->child = $child;
          $return[]=$value;
          if ($this->grand_child($child)) {
            $this->child($child);
          }
        }
      }
      return $return;
    }

    public function grand_child($child){
      $return = FALSE;
      if (!empty($child)) {
        if (count($child) > 0) {
          $return = TRUE;
        }else{
          $return = FALSE;
        }
      }
      return $return;
    }

}
