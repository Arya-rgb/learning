<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public $id = '';

	public function get_data($table)
	{
		// $this->db->select('a.*, b.urutan');
		$this->db->select('a.*');
		$this->db->from($table.' a');
		// $this->db->join('urutan_biodata b', 'a.id = b.id_user', 'LEFT');
		if ($this->id != '') $this->db->where('id', $this->id);
		// $this->db->order_by('b.urutan', 'ASC');
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
