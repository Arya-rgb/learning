<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slearn extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usermodel/m_data');
        $this->load->helper('url');
        $this->load->helper('email');

        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0',false);
        header('Pragma: no-cache');

    }


    function index() {
        if($this->session->userdata("token") != NULL) {
            $this->load->view('user/dashboardUser.php');
        } else {
            $this->load->view('user/dashboard.php');
        }
    }

    public function login() {
    	$data['action'] = base_url($this->class .'/loginUser');
        $this->load->view('user/loginpage', $data);
    }

    function loginUser() {
        $username = $this->input->post('username');
        $passwordInput = $this->input->post('password');
        $password = md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($passwordInput))))))))));
        $token = md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($username))))))))));

        $where = array(
            'username' => $username,
            'password' => $password
        );

        $check = $this->m_data->check_login("data_user", $where)->num_rows();
        if ($check > 0)  {

            $data_session = array(
                'username' => $username,
                'password' => $password,
                'token' => $token
            );

            $this->session->set_userdata($data_session);
            $this->load->view('user/dashboardUser.php');

         } else {

            echo '<script language="javascript">';
            echo 'alert("Username atau password salah !")';
            echo '</script>';
            //echo redirect(base_url("index.php/system/index"));

            }

        }

        function register() {
            $data['action'] = base_url($this->class .'/userAdd');
            $this->load->view('register', $data);
        }

        function userAdd() {

        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $passwordInput = $this->input->post('password');
        $password = md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($passwordInput))))))))));
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

        function courseAndroid() {
            if($this->session->userdata("token") != NULL) {
                $this->load->view('course/course.php');
            } else {
                echo '<script language="javascript">';
                echo 'alert("Akses Dilarang !")';
                echo '</script>';
            }
    }
    function courseAndroid2() {
        if($this->session->userdata("token") != NULL) {
            $this->load->view('course/course.php');
        } else {
            echo '<script language="javascript">';
            echo 'alert("Akses Dilarang !")';
            echo '</script>';
        }
}

function courseAndroid3() {
    if($this->session->userdata("token") != NULL) {
        $this->load->view('user/course3.php');
    } else {
        echo '<script language="javascript">';
        echo 'alert("Akses Dilarang !")';
        echo '</script>';
    }
}

function courseAndroid4() {
    if($this->session->userdata("token") != NULL) {
        $this->load->view('user/course4.php');
    } else {
        echo '<script language="javascript">';
        echo 'alert("Akses Dilarang !")';
        echo '</script>';
    }
}

    function logout() {
			$this->session->sess_destroy();
			redirect(base_url($this->class));
    }
}
