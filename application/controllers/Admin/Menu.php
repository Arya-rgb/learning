<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {
  public $view    = 'Admin/Menu/';
	public function __construct(){
		parent::__construct();
    // if ($this->session->userdata('status') != 'isLogin') {
    //   redirect('login');
    // }
    $this->load->database();
		$this->load->model('Admin/Menu_model','model');
	}

	public function index(){
    $result['data'] = $this->get();
    $result['judul'] = 'Konfigurasi Menu';
    $result['get_data_edit'] = base_url('admin/'.$this->class.'/get_modal');
    $result['get_data_delete'] = base_url('admin/'.$this->class.'/delete');
    $result['controller'] = $this;
    // $result['update_list'] = base_url('admin/'.$this->class.'/update_list');
		$this->load_template('admin/template', $this->view.'display', $result, $this->class);
	}

	public function get($id = '')
	{
		$this->model->id = $id == '' ? $this->input->post('id') : $id;
		$get = $this->model->get_data('m_menu');
    $response['pesan'] = 'Data Tidak Ditemukan';
    $response['status'] = 404;
    $response['data'] = array();
		if ($get->num_rows() > 0) {
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
      $get = $this->model->get_data('m_menu');
      $response['pesan'] = 'data tidak ada';
      $response['status'] = 404;
      $response['data'] = array();
      $response['simpan'] = base_url('admin/'.$this->class.'/save');
      $response['disable'] = 'disabled';
      $response['type'] = ['Header' => 'Header', 'Menu' => 'Menu', 'Sub Menu' => 'Sub Menu'];
      $response['list_parent'] = base_url('admin/'.$this->class.'/list_parent');
      if ($get -> num_rows() > 0) {
        $response['pesan'] = 'data ada';
        $response['status'] = 200;
        $response['data'] = $get->row_array();
        $response['simpan'] = base_url('admin/'.$this->class.'/save');
        $response['disable'] = '';
        $response['type'] = ['Header' => 'Header', 'Menu' => 'Menu', 'Sub Menu' => 'Sub Menu'];
        $response['list_parent'] = base_url('admin/'.$this->class.'/list_parent');
      }
    }else{
      $response['data'] = array();
      $response['simpan'] = base_url('admin/'.$this->class.'/save');
      $response['disable'] = '';
      $response['type'] = ['Header' => 'Header', 'Menu' => 'Menu', 'Sub Menu' => 'Sub Menu'];
      $response['list_parent'] = base_url('admin/'.$this->class.'/list_parent');
    }
    return $this->load->view($this->view.'data_modal', $response);
	}

  public function list_parent()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');
    if ($type == 'Menu') {
      $menu = $this->master_model->data('*', 'm_menu', ['type' => 'Header'])->get()->result();
    }elseif ($type == 'Sub Menu') {
      $menu = $this->master_model->data('*', 'm_menu', ['type' => 'Menu'])->get()->result();
    }
    // dd($menu);
		$lists = "<option value=''>- Pilih -</option>";
		if ($id != '') {
      $own_menu = $this->master_model->data('id_parent', 'm_menu', ['id' => $id])->get()->row();
			foreach ($menu as $data) {
				$check = ($data->id == $own_menu->id_parent) ? 'selected' : '';
				$lists .= "<option value='" . $data->id . "' ".$check.">" . $data->nama_menu . "</option>";
			}
		}else{
			foreach ($menu as $data) {
				$lists .= "<option value='" . $data->id . "'>" . $data->nama_menu . "</option>";
			}
		}

		$callback = array('list_parent' => $lists);
		echo json_encode($callback);
	}

	public function save()
	{
    if ($this->input->post('type') == 'Menu') {
      $conf = [
        array('field' => 'nama_menu', 'label' => 'Nama Menu', 'rules' => 'trim|required|callback_unique'),
        array('field' => 'icon', 'label' => 'Icon', 'rules' => 'trim|required'),
        array('field' => 'target', 'label' => 'Target', 'rules' => 'trim|required'),
        array('field' => 'id_parent', 'label' => 'Parent', 'rules' => 'trim|required'),
      ];
    }elseif ($this->input->post('type') == 'Sub Menu') {
      $conf = [
        array('field' => 'nama_menu', 'label' => 'Nama Menu', 'rules' => 'trim|required|callback_unique'),
        array('field' => 'id_parent', 'label' => 'Parent', 'rules' => 'trim|required'),
        array('field' => 'url', 'label' => 'Url', 'rules' => 'trim|required'),
      ];
    }elseif ($this->input->post('type') == 'Header') {
      $conf = [
        array('field' => 'nama_menu', 'label' => 'Nama Menu', 'rules' => 'trim|required|callback_unique'),
      ];
    }

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
        'id_parent' => $this->input->post('id_parent') != '' ? $this->input->post('id_parent') : NULL,
        'nama_menu' => $this->input->post('nama_menu'),
        'icon' => $this->input->post('icon') != '' ? $this->input->post('icon') : NULL,
        'target' => $this->input->post('target') != '' ? $this->input->post('target') : NULL,
        'url' => $this->input->post('url') != '' ? $this->input->post('url') : NULL,
        'type' => $this->input->post('type') != '' ? $this->input->post('type') : NULL,
      );
      if ($where['id'] != '') {
        $update = $this->model->update_data('m_menu', $data, $where);
        $response['pesan'] = 'Gagal Melakukan Update Menu';
        $response['status'] = 404;
        if ($update) {
          $response['pesan'] = 'Berhasil Melakukan Update Menu';
          $response['status'] = 200;
        }
      }else{
        $create = $this->model->create_data('m_menu', $data);
        $id_user = $this->db->insert_id();
        $response['pesan'] = 'Data Menu Tidak Berhasil Ditambahkan';
        $response['status'] = 404;
        if ($create != 0) {
          // $getLastUrutan = $this->master_model->data('*', 'urutan_biodata')->get()->result_array();
          // $urutan = max(array_column($getLastUrutan, 'urutan')) + 1;
          // $this->master_model->save(['id_user' => $create, 'urutan' => $urutan], 'urutan_biodata');
          $response['pesan'] = 'Data Menu Berhasil Ditambahkan';
          $response['status'] = 200;
        }
      }
    }
      echo json_encode($response);
	}

  public function unique(){
		$id 				= $this->input->post('id');
    $nama_menu 		= $this->input->post('nama_menu');
    $type = $this->input->post('type');
		if (!empty($id)) {
			if ($this->master_model->check_data(['id !='=> $id, 'nama_menu' => $nama_menu],'m_menu')) {
				$this->form_validation->set_message('unique', 'Menu Sudah Ada !');
				return false;
			}
		}else{
			if ($this->master_model->check_data(['nama_menu' => $nama_menu],'m_menu')) {
				$this->form_validation->set_message('unique', 'Menu Sudah Ada !');
				return false;
			}
		}

		return true;
	}

  public function all_child($id, $pading = 20){
      // $condition = array('b.id_parent' => $id);
			$param_query = $this->model->get_data_child('m_menu', $id);
			if ($param_query->num_rows() > 0) {
					foreach ($param_query->result() as $row) {
							$data = array(
									'id' => $row->id,
									'nama_menu' => $row->nama_menu,
									'pading' => $pading,
							);
							echo $this->load->view('admin/'.$this->class.'/child',$data, TRUE);
							if($this->have_child($row->id)){
									$pad = $pading + 20;
									$condition2 = ['b.id_parent' => $row->id];
									$this->all_child($row->id, $pad);
							}
					}
			}
	}

	public function have_child($id){
			// $condition = array('b.id_parent' => $id);
			$param_query = $this->model->get_data_child('m_menu', $id);
			if ($param_query->num_rows() > 0) {
					return TRUE;
			}else{
					return FALSE;
			}
	}

  public function update_list(){
    $posisi = $this->input->post('position');
    $i = 0;
    foreach ($posisi as $key => $value) {
      $i++;
      $this->master_model->update(['urutan' => $i], ['id_user' => $value], 'urutan_biodata');
    }
  }

	public function delete()
  {
    $where['id'] = $this->input->post('id');
    $status = $this->master_model->delete($where, 'm_menu');
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
