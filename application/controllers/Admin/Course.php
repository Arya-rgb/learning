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
    $sub_menu = $this->master_model->data('id_parent, nama_menu', 'm_menu', ['url' => $this->class])->get()->row();
    $menu = $this->master_model->data('nama_menu', 'm_menu', ['id' => $sub_menu->id_parent])->get()->row();
		$this->load_template('admin/template', $this->view.'display', $result, $menu->nama_menu, $sub_menu->nama_menu);
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
      $response['opt_modul'] = options2('ls_m_modul', '', 'id', 'modul', '', '- Pilih -', '', array('id' => 'ASC'));
      if ($get -> num_rows() > 0) {
        $response['pesan'] = 'data ada';
        $response['status'] = 200;
        $response['data'] = $get->row_array();
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
            array('field' => 'id_modul', 'label' => 'Modul', 'rules' => 'trim|required|callback_unique'),
            array('field' => 'judul', 'label' => 'Judul', 'rules' => 'trim|required'),
            array('field' => 'deskripsi', 'label' => 'Deskripsi', 'rules' => 'trim|required'),
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
      if ($_FILES['url_video']['name'] == '') {
        $url_video = $this->input->post('url_video_old');
        $type_video = $this->input->post('type_video_old');
      }else{
        if (file_exists($this->input->post('url_video_old'))) {
          unlink($this->input->post('url_video_old'));
        }
        $cek_uploads = uploadVideo('url_video');
        $url_video = $cek_uploads['nama_file'];
        $type_video = $cek_uploads['type_file'];
      }
      $where['id'] = $this->input->post('id');
      $data = array(
        'id_modul' => $this->input->post('id_modul'),
        'judul' => $this->input->post('judul'),
        'deskripsi' => $this->input->post('deskripsi'),
        'url_video' => $url_video,
        'type_video' => $type_video,
      );
      if ($where['id'] != '') {
        $update = $this->model->update_data('ls_m_course', $data, $where);
        $response['pesan'] = 'Gagal Melakukan Update Course';
        $response['status'] = 404;
        if ($update) {
          $response['pesan'] = 'Berhasil Melakukan Update Course';
          $response['status'] = 200;
        }
      }else{
        $create = $this->model->create_data('ls_m_course', $data);
        $id_user = $this->db->insert_id();
        $response['pesan'] = 'Data Course Tidak Berhasil Ditambahkan';
        $response['status'] = 404;
        if ($create != 0) {
          // $getLastUrutan = $this->master_model->data('*', 'urutan_biodata')->get()->result_array();
          // $urutan = max(array_column($getLastUrutan, 'urutan')) + 1;
          // $this->master_model->save(['id_user' => $create, 'urutan' => $urutan], 'urutan_biodata');
          $response['pesan'] = 'Data Course Berhasil Ditambahkan';
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
    $file = $this->master_model->data('url_video', 'ls_m_course', ['id' => $this->input->post('id')])->get()->row();
    $status = $this->master_model->delete($where, 'ls_m_course');
    $response['pesan'] = 'Data Gagal Dihapus';
    $response['status'] = 404;
    if ($status) {
      if (file_exists($file->url_video)) {
        unlink($file->url_video);
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
