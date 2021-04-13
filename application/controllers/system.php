<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
        $this->load->helper('email');
    }

    function user() {
        $data['testtable'] = $this->m_data->testdata()->result();
        $this->load->view('v_usertest', $data);
    }

    function index() {
        $this->load->view('loginpage.php');
    }

    function loginUser() {
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $email = $this->input->post("email");
        $headline = $this->input->post("headline");
        $tentang_saya = $this->input->post("tentang_saya");

        $where = array(
            'username' => $username,
            'password' => $password
        );
        
        $check = $this->m_data->check_login("data_user", $where)->num_rows();
        if ($check > 0)  {

            $data_session = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'headline' => $headline,
                'tentang_saya' => $tentang_saya
            );

            $this->session->set_userdata($data_session);
            $this->load->view('dashboard.php');

         } else {
             
            echo '<script language="javascript">';
            echo 'alert("Username atau password salah !")';
            echo '</script>';
            //echo redirect(base_url("index.php/system/index"));

            }

        }

        function register() {
            $this->load->view('register.php');
        }

        function userAdd() {

        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $email = $this->input->post("email");
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $headline = $this->input->post("headline");
        $tentang_saya = $this->input->post("tentang_saya");

        $data = array(
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'headline' => $headline,
            'tentang_saya' => $tentang_saya
        );

        $this->m_data->UserAddModel($data, 'data_user');
        echo '<script language="javascript">';
        echo 'alert("Akun Anda Telah Terdaftar")';
        echo '</script>';

        }

    }
