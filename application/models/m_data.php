<?php

class M_data extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->token = 'Ackermanlvii';
    }

    function testdata() {
        return $this->db->get('testtable');
    }

    function check_login($table, $where) {
        
        return $this->db->get_where($table, $where);

    }

    function UserAddModel($data, $table) {
        $this->db->insert($table, $data);
    }

    function acak($text) {
        return md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($text))))))))));
    }

    function cek()
    {
        $where = [
            'username' => $this->req->input('username'),
            'password' => $this->req->acak($this->req->input('password'))
        ];
        $result = $this->db->get_where($this->table, $where);
        if ($result->num_rows() > 0) {
            return [
                'status' => 'ok',
                'data' => array_merge($result->row_array(), ['token' => $this->req->acak(time() . $this->token . $this->req->input('username'))])
            ];
        } else {
            return [
                'status' => 'fail',
                'data' => null
            ];
        }
    }


    

}