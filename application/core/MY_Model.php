<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public $db;

	function __construct()
	{
		parent::__construct();
		ini_set('max_execution_time', '-1');
		ini_set('memory_limit', '-1');
		$this->db = $this->load->database('default', true);
	}

	function data($select = '*', $tabel = '', $and_where = array(), $or_where = array(), $and_where_in = array(), $or_where_in = array(), $having = array(), $or_having = array(), $limit = 0, $offset = 0, $order = '', $like = '', $field_like = '', $usedb = 'default')
	{
		$usedb = $this->load->database($usedb, true);

		if ($select != null && $select != '' && $select != '*') {
			$usedb->select($select);
		}

		$usedb->from($tabel);

		if (is_array($and_where)) {
			$usedb->where($and_where);
		}

		if (is_array($or_where)) {
			$usedb->or_where($or_where);
		}

		if (is_array($and_where_in)) {
			if (count($and_where_in) == 2) {
				if (isset($and_where_in[0]) and isset($and_where_in[1])) {
					if (is_string($and_where_in[0]) and is_array($and_where_in[1])) {
						$usedb->where_in($and_where_in[0], $and_where_in[1]);
					}
				}
			}
		}

		if (is_array($or_where_in)) {
			if (count($or_where_in) == 2) {
				if (isset($or_where_in[0]) and isset($or_where_in[1])) {
					if (is_string($or_where_in[0]) and is_array($or_where_in[1])) {
						$usedb->or_where_in($or_where_in[0], $or_where_in[1]);
					}
				}
			}
		}

		if (is_array($having)) {
			$usedb->having($having);
		}

		if (is_array($or_having)) {
			$usedb->or_having($or_having);
		}

		if ($like) {
			if (is_array($field_like)) {
				$usedb->group_start();
				$i = 0;
				foreach ($field_like as $key => $value) {
					if (is_numeric($like)) {
						if ($i == 0) {
							$usedb->like("CAST(" . $value . " as TEXT)", $like);
						} else {
							$usedb->or_like("CAST(" . $value . " as TEXT)", $like);
						}
					} else {
						if ($i == 0) {
							$usedb->like("LOWER(CAST(" . $value . " as TEXT))", strtolower($like));
						} else {
							$usedb->or_like("LOWER(CAST(" . $value . " as TEXT))", strtolower($like));
						}
					}
					$i++;
				}
				$usedb->group_end();
			} else {
				if (is_numeric($like)) {
					$usedb->like("CAST(" . $field_like . " as TEXT)", $like);
				} else {
					$usedb->like("LOWER(CAST(" . $field_like . ") as TEXT)", strtolower($like));
				}
			}
		}

		if ($order) {
			$usedb->order_by($order);
		}

		if ($limit > 0) {
			$usedb->limit($limit, $offset);
		}

		return $usedb;
	}

	function save($data = array(), $table = '', $usedb = 'default')
	{
		$usedb 				= $this->load->database($usedb, true);
		return $usedb->insert($table, $data);
	}

	function save_batch($data, $table = '', $usedb = 'default')
	{
		$usedb 				= $this->load->database($usedb, true);
		return $usedb->insert_batch($table, $data);
	}

	function update($set = array(), $where = array(), $tabel = '', $usedb = 'default')
	{
		$usedb 				= $this->load->database($usedb, true);
		$update 			= $usedb->set($set);
		$update 			= $usedb->where($where);
		$update 			= $usedb->update($tabel);
		return $update;
	}

	function delete($where = array(), $tabel = '', $usedb = 'default')
	{
		$usedb 				= $this->load->database($usedb, true);
		$hasil 				= FALSE;
		if (!empty($where) and $tabel != NULL) {
			$hasil 			= $usedb->where($where);
			$hasil 			= $usedb->delete($tabel);
		}
		return $hasil;
	}

	function reset($tabel = '', $usedb = 'default')
	{
		$usedb 				= $this->load->database($usedb, true);
		return $usedb->truncate($tabel);
	}

	public function coltoarray($table = '', $column_key = '', $column_value = '', $cond = '')
	{

		if ($cond) {
			$this->db->where($cond);
		}
		$q = $this->db->get($table);
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $row) {
				if ($column_key) {
					$data[$row[$column_key]] = $row[$column_value];
				} else {
					$data[] = $row[$column_value];
				}
			}
			return $data;
		}
		return array();
	}

	function data_list($key = '', $limit = 0, $offset = 0, $table = '', $select = '', $order = '', $like = '', $field_like = '', $usedb = 'default', $distinct = '')
	{
		$usedb = $this->load->database($usedb, true);

		if ($distinct)
			$usedb->distinct($distinct);
		if ($select != null && $select != '' && $select != '*') {
			$usedb->select($select);
		}


		//$usedb->select($select);
		$usedb->from($table);

		if (is_array($key)) {
			$usedb->where($key);
		}

		if ($like) {
			if (is_array($field_like)) {
				// $usedb->group_start();
				$i = 0;
				foreach ($field_like as $key => $value) {
					if ($i == 0) {
						$usedb->like($value, $like);
					} else {
						$usedb->or_like($value, $like);
					}
					$i++;
				}
				// $usedb->group_end();
			} else {
				$usedb->like($field_like, $like);
			}
		}

		if ($order) {
			$usedb->order_by($order);
		}

		if ($limit > 0) {
			$usedb->limit($limit, $offset);
		}

		return $usedb;
	}

	function selectFiles($id, $modul)
	{
		$this->db->from('m_files');
		$this->db->where('trans_id', $id);
		$this->db->where('url', $modul);

		$data = $this->db->get();
		return $data;
	}

	public function find($table = '', $cond)
	{
		$q = $this->db->get_where($table, $cond);
		return $q;
	}

	function check_data($conditions = array(), $table = '')
	{
		$this->db->where($conditions);
		$this->db->limit(1);
		if ($table == '') {
			$table = $this->_table1;
		}
		$q     = $this->db->get($table);
		if ($q->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function findfirst($table = '', $cond)
	{
		$q = $this->find($table, $cond);
		if ($q->num_rows() > 0) {
			$q = $q->result();
			return $q[0];
		}
		return array();
	}

	function selectFilesByclass($id, $class)
	{
		$this->db->from('m_files');
		$this->db->where('trans_id', $id);
		$this->db->where('modul', $class);

		$data = $this->db->get();
		return $data;
	}

}
