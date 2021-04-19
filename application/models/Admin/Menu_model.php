<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public $id = '';

	public function get_data($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where(['id_parent' => NULL, 'target' => NULL, 'url' => NULL]);
		// $this->db->order_by('id', 'DESC');
		return $this->db->get();
	}

	public function get_data_child($table, $id)
	{
		$this->db->select('b.nama_menu, b.id');
		$this->db->from($table.' a');
		$this->db->join($table.' b', 'a.id = b.id_parent', 'left');
		$this->db->where('b.id_parent', $id);
		// $this->db->order_by('b.id', 'ASC');
		return $this->db->get();
	}

	public function create_data($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_data($table, $data, $where)
	{
		$this->db->from($table);
		$this->db->set($data);
		$this->db->where($where);
		return $this->db->update();
	}

}
