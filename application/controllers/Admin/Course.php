<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller {
  public $view    = 'Admin/Course/';
	public function __construct(){
		parent::__construct();
    // if ($this->session->userdata('status') != 'isLogin') {
    //   redirect('login');
    // }
    $this->load->database();
		$this->load->model('Admin/Course_model','model');
	}

	public function index(){
    $result['data'] = $this->get();
    $result['judul'] = 'Course List';
    $result['get_data_edit'] = base_url('admin/'.$this->class.'/get_modal');
    $result['get_data_delete'] = base_url('admin/'.$this->class.'/delete');
    // $result['update_list'] = base_url('admin/'.$this->class.'/update_list');
		$this->load_template('admin/template', $this->view.'display', $result, $this->class);
	}

	public function get($id = '')
	{
		$this->model->id = $id == '' ? $this->input->post('id') : $id;
		$get = $this->model->get_data('ls_m_course');
    $response['pesan'] = 'Data Tidak Ditemukan';
    $response['status'] = 404;
    $response['data'] = array();
		if ($get -> num_rows() > 0) {
        $response['pesan'] = 'Data Ditemukan';
        $response['status'] = 200;
        $response['data'] = $get->result_array();
    }
    return $response;
	}

  public function get_modal()
	{
    $id = $this->input->post('id');
    if ($id != '') {
      $this->model->id = $id;
      $get = $this->model->get_data('ls_m_course');
      $response['pesan'] = 'data tidak ada';
      $response['status'] = 404;
      $response['data'] = array();
      $response['simpan'] = base_url('admin/'.$this->class.'/save');
      $response['disable'] = 'disabled';
      if ($get -> num_rows() > 0) {
        $response['pesan'] = 'data ada';
        $response['status'] = 200;
        $response['data'] = $get->row_array();
        $response['simpan'] = base_url('admin/'.$this->class.'/save');
        $response['disable'] = '';
      }
    }else{
      $response['data'] = array();
      $response['simpan'] = base_url('admin/'.$this->class.'/save');
      $response['disable'] = '';
    }
    return $this->load->view($this->view.'data_modal', $response);
	}

	public function save()
	{
    $conf = array(
            array('field' => 'judul', 'label' => 'Judul', 'rules' => 'trim|required|callback_unique'),
            array('field' => 'sub_judul', 'label' => 'Sub Judul', 'rules' => 'trim|required'),
            array('field' => 'deskripsi', 'label' => 'Deskripsi', 'rules' => 'trim|required'),
            array('field' => 'url_video', 'label' => 'Url Video', 'rules' => 'trim|required'),
        );

    $this->form_validation->set_rules($conf);
    $this->form_validation->set_message('required', '%s tidak boleh kosong.');
    $this->form_validation->set_message('numeric', '%s harus berisi nomor.');
    $this->form_validation->set_message('matches', '%s tidak cocok.');
    $this->form_validation->set_message('min_length', '%s minimal %s digit.');
    $this->form_validation->set_message('valid_email', '%s harus valid.');
    $this->form_validation->set_message('is_unique', '%s tidak boleh sama.');

    if ($this->form_validation->run() === FALSE) {
      $respones['status'] = 404;
      $response['pesan']  = validation_errors();
    }else {
      $where['id'] = $this->input->post('id');
      $data = array(
        'judul' => $this->input->post('judul'),
        'sub_judul' => $this->input->post('sub_judul'),
        'deskripsi' => $this->input->post('deskripsi'),
        'url_video' => $this->input->post('url_video'),
      );
      if ($where['id'] != '') {
        $update = $this->model->update_data('ls_m_course', $data, $where);
        $response['pesan'] = 'Gagal Melakukan Update Users';
        $response['status'] = 404;
        if ($update) {
          $response['pesan'] = 'Berhasil Melakukan Update Users';
          $response['status'] = 200;
        }
      }else{
        $create = $this->model->create_data('ls_m_course', $data);
        $id_user = $this->db->insert_id();
        $response['pesan'] = 'Data Users Tidak Berhasil Ditambahkan';
        $response['status'] = 404;
        if ($create != 0) {
          // $getLastUrutan = $this->master_model->data('*', 'urutan_biodata')->get()->result_array();
          // $urutan = max(array_column($getLastUrutan, 'urutan')) + 1;
          // $this->master_model->save(['id_user' => $create, 'urutan' => $urutan], 'urutan_biodata');
          $response['pesan'] = 'Data Users Berhasil Ditambahkan';
          $response['status'] = 200;
        }
      }
    }
      echo json_encode($response);
	}

  public function unique(){
		$id 				= $this->input->post('id');
    $judul 		= strtolower($this->input->post('judul'));
		if (!empty($id)) {
			if ($this->master_model->check_data(['id !='=> $id, 'lower(judul)' => $judul],'ls_m_course')) {
				$this->form_validation->set_message('unique', 'Judul Sudah Ada !');
				return false;
			}
		}else{
			if ($this->master_model->check_data(['judul' => $judul],'ls_m_course')) {
				$this->form_validation->set_message('unique', 'Judul Sudah Ada !');
				return false;
			}
		}

		return true;
	}

	public function delete()
  {
    $where['id'] = $this->input->post('id');
    $status = $this->master_model->delete($where, 'ls_m_course');
    // $urutan = $this->master_model->delete(['id_user' => $this->input->post('id')], 'urutan_biodata');
    $response['pesan'] = 'Data Gagal Dihapus';
    $response['status'] = 404;
    if ($status) {
      $response['pesan'] = 'Data Berhasil Dihapus';
      $response['status'] = 200;
    }
    // if ($status && $urutan) {
    //   $response['pesan'] = 'Data Berhasil Dihapus';
    //   $response['status'] = 200;
    // }
    echo json_encode($response);
  }

}
