<?php

class M_data extends CI_Model {
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

}