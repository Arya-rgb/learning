<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
  public $view    = 'Admin/Users/';
	public function __construct(){
		parent::__construct();
    // if ($this->session->userdata('status') != 'isLogin') {
    //   redirect('login');
    // }
    $this->load->database();
		$this->load->model('Admin/Users_model','model');
	}

	public function index(){
    $result['data'] = $this->get();
    $result['judul'] = 'Users';
    $result['get_data_edit'] = base_url('admin/'.$this->class.'/get_modal');
    $result['get_data_delete'] = base_url('admin/'.$this->class.'/delete');
    $result['get_reset_password'] = base_url('admin/'.$this->class.'/reset_password');
    $result['update_list'] = base_url('admin/'.$this->class.'/update_list');
    $sub_menu = $this->master_model->data('id_parent, nama_menu', 'm_menu', ['url' => $this->class])->get()->row();
    $menu = $this->master_model->data('nama_menu', 'm_menu', ['id' => $sub_menu->id_parent])->get()->row();
		$this->load_template('admin/template', $this->view.'display', $result, $menu->nama_menu, $sub_menu->nama_menu);
	}

	public function get($id = '')
	{
		$this->model->id = $id == '' ? $this->input->post('id') : $id;
		$get = $this->model->get_data('ls_m_user');
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
      $get = $this->model->get_data('ls_m_user');
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
            array('field' => 'nama_lengkap', 'label' => 'Nama', 'rules' => 'trim|required|callback_unique'),
            array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
            array('field' => 'headline', 'label' => 'Headline', 'rules' => 'trim|required'),
            array('field' => 'tentang_saya', 'label' => 'Tentang Saya', 'rules' => 'trim|required'),
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
      if ($where['id'] != '') {
        $data = array(
          'nama_lengkap' => $this->input->post('nama_lengkap'),
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'headline' => $this->input->post('headline'),
          'tentang_saya' => $this->input->post('tentang_saya'),
        );
        $update = $this->model->update_data('ls_m_user', $data, $where);
        $response['pesan'] = 'Gagal Melakukan Update Users';
        $response['status'] = 404;
        if ($update) {
          $response['pesan'] = 'Berhasil Melakukan Update Users';
          $response['status'] = 200;
        }
      }else{
        $data = array(
          'nama_lengkap' => $this->input->post('nama_lengkap'),
          'username' => $this->input->post('username'),
          'password' => md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($this->input->post('password'))))))))))),
          'email' => $this->input->post('email'),
          'headline' => $this->input->post('headline'),
          'tentang_saya' => $this->input->post('tentang_saya'),
        );
        $create = $this->model->create_data('ls_m_user', $data);
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
    $username 		= $this->input->post('username');
		$password 		= $this->input->post('password');
		$email 		= $this->input->post('email');
		if (!empty($id)) {
			if ($this->master_model->check_data(['id !='=> $id, 'username' => $username],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Username Sudah Ada !');
				return false;
			}
      if ($this->master_model->check_data(['id !='=> $id, 'password' => $password],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Password Sudah Ada !');
				return false;
			}
      if ($this->master_model->check_data(['id !='=> $id, 'email' => $email],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Email Sudah Ada !');
				return false;
			}
		}else{
			if ($this->master_model->check_data(['username' => $username],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Username Sudah Ada !');
				return false;
			}
      if ($this->master_model->check_data(['password' => $password],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Password Sudah Ada !');
				return false;
			}
      if ($this->master_model->check_data(['email' => $email],'ls_m_user')) {
				$this->form_validation->set_message('unique', 'Email Sudah Ada !');
				return false;
			}
		}

		return true;
	}

  public function update_list(){
    $posisi = $this->input->post('position');
    $i = 0;
    foreach ($posisi as $key => $value) {
      $i++;
      $this->master_model->update(['urutan' => $i], ['id_user' => $value], 'urutan_biodata');
    }
  }

  public function reset_password(){
    $get_data = $this->master_model->data('username', 'ls_m_user', ['id' => $this->input->post('id')])->get()->row();
    $where['id'] = $this->input->post('id');
    $new_password = md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($get_data->username))))))))));
    $update = $this->master_model->update(['password' => $new_password], $where, 'ls_m_user');
    if ($update) {
      $response['pesan'] = "Password berhasil di reset !";
      $response['status'] = 200;
    }else{
      $response['pesan'] = "Password gagal di reset !";
      $response['status'] = 404;
    }

    echo json_encode($response);
  }

	public function delete()
  {
    $where['id'] = $this->input->post('id');
    $status = $this->master_model->delete($where, 'ls_m_user');
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
