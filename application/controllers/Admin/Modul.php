<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends MY_Controller {
  public $view    = 'Admin/Modul/';
	public function __construct(){
		parent::__construct();
    // if ($this->session->userdata('status') != 'isLogin') {
    //   redirect('login');
    // }
    $this->load->database();
		$this->load->model('Admin/Modul_model','model');
	}

	public function index(){
    $result['data'] = $this->get();
    $result['judul'] = 'Modul List';
    $result['get_data_edit'] = base_url('admin/'.$this->class.'/get_modal');
    $result['get_data_delete'] = base_url('admin/'.$this->class.'/delete');
    // $result['update_list'] = base_url('admin/'.$this->class.'/update_list');
    $sub_menu = $this->master_model->data('id_parent, nama_menu', 'm_menu', ['url' => $this->class])->get()->row();
    $menu = $this->master_model->data('nama_menu', 'm_menu', ['id' => $sub_menu->id_parent])->get()->row();
		$this->load_template('admin/template', $this->view.'display', $result, $menu->nama_menu, $sub_menu->nama_menu);
	}

	public function get($id = '')
	{
		$this->model->id = $id == '' ? $this->input->post('id') : $id;
		$get = $this->model->get_data('ls_m_modul');
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
      $get = $this->model->get_data('ls_m_modul');
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
            array('field' => 'modul', 'label' => 'Modul', 'rules' => 'trim|required|callback_unique'),
            // array('field' => 'gambar', 'label' => 'Gambar', 'rules' => 'trim|required'),
            array('field' => 'deskripsi', 'label' => 'Deskripsi', 'rules' => 'trim|required'),
            array('field' => 'url', 'label' => 'Url', 'rules' => 'trim|required'),
            // array('field' => 'url_video', 'label' => 'Url Video', 'rules' => 'trim|required'),
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
      if ($_FILES['gambar']['name'] == '') {
        $gambar = $this->input->post('gambar_old');
        $data = array(
          'modul' => $this->input->post('modul'),
          'url' => $this->input->post('url'),
          'deskripsi' => $this->input->post('deskripsi'),
          'gambar' => $gambar,
        );
      }else{
        if (file_exists($this->input->post('gambar_old'))) {
          unlink($this->input->post('gambar_old'));
        }
        $cek_uploads = uploadGambar('gambar');
        $gambar = $cek_uploads['nama_file'];
        $type_gambar = $cek_uploads['type_file'];
        $data = array(
          'modul' => $this->input->post('modul'),
          'url' => $this->input->post('url'),
          'deskripsi' => $this->input->post('deskripsi'),
          'gambar' => $gambar,
          'type_gambar' => $type_gambar,
        );
      }
      $where['id'] = $this->input->post('id');
      if ($where['id'] != '') {
        $update = $this->model->update_data('ls_m_modul', $data, $where);
        $response['pesan'] = 'Gagal Melakukan Update Main Course';
        $response['status'] = 404;
        if ($update) {
          $response['pesan'] = 'Berhasil Melakukan Update Main Course';
          $response['status'] = 200;
        }
      }else{
        $create = $this->model->create_data('ls_m_modul', $data);
        $id_user = $this->db->insert_id();
        $response['pesan'] = 'Data Main Course Tidak Berhasil Ditambahkan';
        $response['status'] = 404;
        if ($create != 0) {
          // $getLastUrutan = $this->master_model->data('*', 'urutan_biodata')->get()->result_array();
          // $urutan = max(array_column($getLastUrutan, 'urutan')) + 1;
          // $this->master_model->save(['id_user' => $create, 'urutan' => $urutan], 'urutan_biodata');
          $response['pesan'] = 'Data Main Course Berhasil Ditambahkan';
          $response['status'] = 200;
        }
      }
    }
      echo json_encode($response);
	}

  public function unique(){
		$id 				= $this->input->post('id');
    $modul 		= strtolower($this->input->post('modul'));
		if (!empty($id)) {
			if ($this->master_model->check_data(['id !='=> $id, 'lower(modul)' => $modul],'ls_m_modul')) {
				$this->form_validation->set_message('unique', 'Modul Sudah Ada !');
				return false;
			}
		}else{
			if ($this->master_model->check_data(['modul' => $modul],'ls_m_modul')) {
				$this->form_validation->set_message('unique', 'Modul Sudah Ada !');
				return false;
			}
		}

		return true;
	}

	public function delete()
  {
    $where['id'] = $this->input->post('id');
    $file = $this->master_model->data('gambar', 'ls_m_modul', ['id' => $this->input->post('id')])->get()->row();
    $status = $this->master_model->delete($where, 'ls_m_modul');
    $response['pesan'] = 'Data Gagal Dihapus';
    $response['status'] = 404;
    if ($status) {
      if (file_exists($file->gambar)) {
        unlink($file->gambar);
      }
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
