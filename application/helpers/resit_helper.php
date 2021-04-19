<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_value')) {
	function get_value($select = '', $from = '', $and_where = array(), $or_where = array(), $like = '', $field_like = '', $db = 'default')
	{
		$CI 						= &get_instance();
		$CI->load->model('master_model');
		$hasil 						= null;
		if ($select != null and $from != null and ($and_where != null or $or_where != null or ($like != null and $field_like != null))) {
			$select 				= $select . ' AS kolom';
			$data 					= $CI->master_model->data($select, $from, $and_where, $or_where, null, null, null, null, null, null, null, $like, $field_like, $db)->get();
			if ($data->num_rows() > 0) {
				$field 				= $data->row_array();
				$hasil 				= $field['kolom'];
			}
		}
		return $hasil;
	}
}
if (!function_exists('uploadVideo')) {
	function uploadVideo($nama)
		{
			$CI = &get_instance();
			$upload_path = 'uploads/course_video/';
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = '*';
      $config['max_size'] = 1024 * 100;
      $config['encrypt_name'] = false;

	    $CI->load->library('upload', $config);
			$CI->upload->initialize($config);
	    if (!$CI->upload->do_upload($nama)) {
				$response['pesan'] = FALSE;
				$response['nama_file'] = '';
				$response['type_file'] = '';
	    }else{
					$response['pesan'] = TRUE;
					$response['nama_file'] = base_url().$upload_path.$CI->upload->data('file_name');
					$response['type_file'] = $CI->upload->data('file_type');
			}
			return $response;
		}
}
if (!function_exists('options')) {
	function options($table = '', $key = array(), $value = '', $label = '', $html = '', $default = '', $def_value = '', $order_by = '', $group_by = '', $db = 'default')
	{
		$CI = &get_instance();
		$db = $CI->load->database($db, TRUE);
		$db->from($table);
		if (!empty($key) || is_array($key)) {
			$db->where($key);
		}
		if ($order_by) {
			if (is_array($order_by)) {
				foreach ($order_by as $key_order => $val_order) {
					$db->order_by($key_order, $val_order);
				}
			} else {
				$db->order_by($order_by);
			}
		}
		if ($group_by) {
			$db->group_by($group_by);
		}
		$query = $db->get();

		$option = '';
		if ($html != '') {
			if ($default != '') {
				$option = '<option value="' . $def_value . '">' . $default . '</option>';
			}
		} else {
			if ($default != '') {
				$option[$def_value] = $default;
			}
		}

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				if (is_array($label)) {
					$label_multiple = array();
					foreach ($label as $key_label => $value_label) {
						$label_multiple[] = str_replace("'", " ", $row->$value_label);
					}

					if ($html != '') {
						$option .= '<option value="' . $row->$value . '">' . str_replace("'", " ", implode(' - ', $label_multiple)) . '</option>';
					} else {
						$option[$row->$value] = str_replace("'", " ", implode(' - ', $label_multiple));
					}
				} else {
					if ($html != '') {
						$option .= '<option value="' . $row->$value . '">' . str_replace("'", " ", $row->$label) . '</option>';
					} else {
						$option[$row->$value] = str_replace("'", " ", $row->$label);
					}
				}
			}
		}
		return $option;
	}
}
function options2($table = '', $key = array(), $value = '', $label = '', $html = '', $default = '', $def_value = '', $order_by = '', $group_by = '', $db = 'default', $wherein = array())
{
	$CI = &get_instance();
	$db = $CI->load->database($db, TRUE);
	$db->from($table);
	if (!empty($key) || is_array($key)) {
		$db->where($key);
	}
	if ($order_by) {
		if (is_array($order_by)) {
			foreach ($order_by as $key_order => $val_order) {
				$db->order_by($key_order, $val_order);
			}
		} else {
			$db->order_by($order_by);
		}
	}
	if ($group_by) {
		$db->group_by($group_by);
	}
	if (!empty($wherein)) {
		$db->where_in($wherein['col'], $wherein['val']);
	}
	$query = $db->get();

	$option = '';
	if ($html != '') {
		if ($default != '') {
			$option = '<option value="' . $def_value . '">' . $default . '</option>';
		}
	} else {
		$option = [];
		if ($default != '') {
			$option[$def_value] = $default;
		}
	}

	if ($query->num_rows() > 0) {
		foreach ($query->result() as $row) {
			if (is_array($label)) {
				$label_multiple = array();
				foreach ($label as $key_label => $value_label) {
					$label_multiple[] = str_replace("'", " ", $row->$value_label);
				}

				if ($html != '') {
					$option .= '<option value="' . $row->$value . '">' . str_replace("'", " ", implode(' - ', $label_multiple)) . '</option>';
				} else {
					$option[$row->$value] = str_replace("'", " ", implode(' - ', $label_multiple));
				}
			} else {
				if ($html != '') {
					$option .= '<option value="' . $row->$value . '">' . str_replace("'", " ", $row->$label) . '</option>';
				} else {
					$option[$row->$value] = str_replace("'", " ", $row->$label);
				}
			}
		}
	}
	return $option;
}

if (!function_exists('get_data')) {
	function get_data($select = '', $from = '', $and_where = array(), $or_where = array(), $like = '', $field_like = '', $order_by = '', $db = 'default')
	{
		$CI 					= &get_instance();
		$CI->load->model('master_model');
		$data 					= $CI->master_model->data($select, $from, $and_where, $or_where, null, null, null, null, null, null, $order_by, $like, $field_like, $db);
		return $data;
	}
}
if (!function_exists('get_count')) {
	function get_count($from = '', $and_where = array(), $or_where = array(), $like = '', $field_like = '', $db = 'default')
	{
		$CI 					= &get_instance();
		$CI->load->model('master_model');
		$data 					= $CI->master_model->data('count(*) as jumlah', $from, $and_where, $or_where, null, null, null, null, null, null, null, $like, $field_like, $db)->get();
		$field 					= $data->row();
		return $field->jumlah;
	}
}
if (!function_exists('cari_array')) {
	function cari_array($array, $search_list)
	{
		$result 			= array();
		foreach ($array as $key => $value) {
			foreach ($search_list as $k => $v) {
				if (!isset($value[$k]) || $value[$k] != $v) {
					continue 2;
				}
			}
			$result[] 		= $value;
		}
		return $result;
	}
}
if (!function_exists('offset')) {
	function offset($limit = 0, $page = 1)
	{
		$hasil = ($page > 1) ? ($page * $limit) - $limit : 0;
		return $hasil;
	}
}
if (!function_exists('jumlah_page')) {
	function jumlah_page($limit = 0, $jumlah_data = 0)
	{
		$hasil = 1;
		if ($limit > 0) {
			$hasil = ceil($jumlah_data / $limit);
		}
		return $hasil;
	}
}

if (!function_exists('start_page')) {
	function start_page($page_aktif = 1, $range_page = 1)
	{
		return ($page_aktif > $range_page) ? $page_aktif - $range_page : 1;
	}
}
if (!function_exists('end_page')) {
	function end_page($page_aktif = 1, $range_page = 1, $jumlah_page = 1)
	{
		return ($page_aktif < ($jumlah_page - $range_page)) ? $page_aktif + $range_page : $jumlah_page;
	}
}
if (!function_exists('boolean_input')) {
	function boolean_input($value = '')
	{
		$hasil 			= 'f';
		if ($value != null) {
			$hasil 		= $value;
		} else {
			$hasil 		= 'f';
		}
		return $hasil;
	}
}

if (!function_exists('text_to_bln_short')) {
	function text_to_bln_short($tgl)
	{
		$xreturn_ = '';
		if (strlen($tgl) == 7) {
			$bln = substr($tgl, 0, 2);
			$thn = substr($tgl, 3, 5);
		}

		if (trim($bln) != '' and $bln != '0') {
			$getbulan = array();
			$getbulan[1] = 'Jan';
			$getbulan[2] = 'Feb';
			$getbulan[3] = 'Mar';
			$getbulan[4] = 'Apr';
			$getbulan[5] = 'Mei';
			$getbulan[6] = 'Jun';
			$getbulan[7] = 'Jul';
			$getbulan[8] = 'Aug';
			$getbulan[9] = 'Sep';
			$getbulan[10] = 'Oct';
			$getbulan[11] = 'Nov';
			$getbulan[12] = 'Dec';
		}

		//return $xreturn_;
		return $getbulan[(int)$bln] . '-' . $thn;
	}
}

function tgl_ind_to_eng($tgl)
{
	$xreturn_ = '';
	if (trim($tgl) != '' && $tgl != '00-00-0000') {
		$tgl_eng = substr($tgl, 6, 4) . "-" . substr($tgl, 3, 2) . "-" . substr($tgl, 0, 2);
		$xreturn_ = $tgl_eng;
	}
	return $xreturn_;
}

if (!function_exists('format_date_ind')) {
	function format_date_ind($tgl, $param = 'short')
	{
		if (trim($tgl) != '' and $tgl != '0000-00-00') {
			$d = substr($tgl, 8, 2);
			$m = substr($tgl, 5, 2);
			$y = substr($tgl, 0, 4);
			$getbulan = array();
			$getbulan[1] = (($param == 'short') ? 'Jan' : 'Januari');
			$getbulan[2] = (($param == 'short') ? 'Feb' : 'Februari');
			$getbulan[3] = (($param == 'short') ? 'Mart' : 'Maret');
			$getbulan[4] = (($param == 'short') ? 'Apr' : 'April');
			$getbulan[5] = (($param == 'short') ? 'Mei' : 'Mei');
			$getbulan[6] = (($param == 'short') ? 'Jun' : 'Juni');
			$getbulan[7] = (($param == 'short') ? 'Jul' : 'Juli');
			$getbulan[8] = (($param == 'short') ? 'Agst' : 'Agustus');
			$getbulan[9] = (($param == 'short') ? 'Sept' : 'September');
			$getbulan[10] = (($param == 'short') ? 'Okt' : 'Oktober');
			$getbulan[11] = (($param == 'short') ? 'Nov' : 'November');
			$getbulan[12] = (($param == 'short') ? 'Des' : 'Desember');
			$tanggal = $d . " " . $getbulan[(int)$m] . " " . $y;
			return $tanggal;
		}
	}
}

function getCount($from, $where, $array = array(), $db = 'default')
{
	$CI = &get_instance();
	$db = $CI->load->database($db, TRUE);
	if (is_array($where)) {
		$db->select('count(*) as jml');
		$db->from($from);
		$db->where($where);
		$query = $db->get();
	} else {
		$sql = "select count(*) as jml from " . $from . " where " . $where;
		$query = $db->query($sql, $array);
	}
	// echo $db->last_query();die;
	$field = $query->row();
	return $field->jml;
}

function posisi($date)
{
	$cekpos = explode('-', $date);
	// dd($cekpos);
	// if (count($cekpos) == 2) {
	// 	$date = $cekpos[1] . '-' . $cekpos[2];
	// }
	// dd($date);

	$data['tgl'] = date('d', strtotime($date));
	$data['bulan'] = date('n', strtotime($date));
	$data['tahun'] = date('Y', strtotime($date));

	return $data;
}

function getValue($select, $from, $where, $array = array(), $db = 'default')
{
	$CI = &get_instance();
	$db = $CI->load->database($db, TRUE);
	if (is_array($where)) {
		$db->distinct();
		$db->select($select . ' AS nm_field');
		$db->from($from);
		$db->where($where);
		$query = $db->get();
	} else {
		$sql = "SELECT DISTINCT " . $select . " AS nm_field FROM " . $from . " WHERE " . $where;
		$query = $db->query($sql, $array);
	}

	$hasil = '';
	if ($query->num_rows() > 0) {
		$field = $query->row_array();
		$hasil = $field['nm_field'];
	}
	return $hasil;
}

// function Form_review($posisi = '', $indikator_id, $parent_id = '', $kd_loker, $modul = '', $tabel = '', $idname = '', $dbname = 'default', $adj = '1', $role_user, $kategori, $loker_review)
// {
// 	$CI = &get_instance();
// 	// if (!in_array($modul, array('rpcabang', 'rpkri', 'riskcontrol'))) {
// 	$simpan = 'SimpanReview';
// 	// }else{
// 	// $simpan = 'ProsesReview';
// 	// }

// 	$rdir = $CI->session->userdata('rdir');
// 	$this_url = $CI->session->userdata('s_url');
// 	$url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : (!empty($rdir) ? site_url($rdir) : site_url(''));
// 	$data = array(
// 		'posisi' => $posisi,
// 		'tabel' => $tabel,
// 		'adj' => $adj,
// 		'idname' => $idname,
// 		'dbname' => $dbname,
// 		'indikator_id' => $indikator_id,
// 		'kd_loker' => $kd_loker,
// 		'role_user' => $role_user,
// 		'kategori' => $kategori,
// 		'loker_review' => $loker_review,
// 		'parent_id' => $parent_id,
// 		'modul' => $modul,
// 		'url' => $url,
// 		'uri_segment' => $CI->uri->uri_string(),
// 		'action_review' => site_url($this_url . '/' . $simpan),
// 	);

// 	$CI->load->view('common/form_review', $data, FALSE);
// }
function text_area($text = null)
{
	return str_replace(array('\r', '\n'), array(chr(13), chr(10)), str_replace("\\\\", "\\", str_replace("\'", "'", $text)));
}
function text_area_br($text = null)
{
	return str_replace(array(chr(13), chr(10)), '<br>', text_area($text));
}
function tgl_eng_to_ind($tgl)
{
	$xreturn_ = '';
	if (trim($tgl) != '' and $tgl != '0000-00-00') {
		$tgl_ind = substr($tgl, 8, 2) . "-" . substr($tgl, 5, 2) . "-" . substr($tgl, 0, 4);
		$xreturn_ = $tgl_ind;
	}
	return $xreturn_;
}
// function newNotif($role_id = '', $kd_loker)
// {
// 	// $t       = new notification;
// 	$CI      = &get_instance();
// 	$CI->load->model('master_model');
// 	if (empty($role_id)) {
// 		$role_id = $CI->session->userdata('s_id_role');
// 	}

// 	return $CI->master_model->show_notif([
// 		'st_viewed' => 0,
// 		'action_to_do' => 'R',
// 		'kd_loker' => $kd_loker
// 	]);

// 	// return $CI->master_model->data(null, 't_notification', array('role_id'   => $role_id, 'kd_loker' => $kd_loker, 'st_viewed' => 0, 'action_to_do' => 'R'))->order_by('created_at', 'DESC')->get();
// }

function get_format($num, $f = 'nominal', $dec = 0, $blk = '.', $kom = ',')
{
    if (is_numeric($num) && $num > 0) {
        if ($f == 'nominal') {
            return number_format($num, $dec, $blk, $kom);
        }

        if ($f == 'number') {
            return $num;
        }
    } else {
        if ($f == 'number') {
            return (($num == 0) ? '' : $num);
        } else {
            return $num;
        }
    }
}

function posisi_triwulan($posisi)
{
    $posBaru = explode('-', $posisi);
    $posBulan[] = date('n', strtotime($posBaru[0]));
    $posBulan[] = date('n', strtotime($posBaru[1]));
    $posBulan[] = $posBaru[2];
    return $posBulan;
}

function getMultiAuditeeName($cond){
	$CI      = &get_instance();
	$CI->load->model('master_model');
	$unit= '';
	$id= '';
	if (!empty($cond)) {
		$CI->db->select("a.*");
		$CI->db->from('m_unit_kerja' . ' a');
		$CI->db->where_in('id',$cond);
		$query = $CI->db->get();
		if ($query->num_rows() > 0 )  {
			foreach ($query->result() as $key => $val) {
				$unit .= $val->nama_unit_kerja;
				if ($key != ($query->num_rows() - 1)) {
					$unit .= ', ';
				}
			}
		}
	}
	return $unit;
}

function getTotalMultiAuditee($cond){
	$CI      = &get_instance();
	$CI->load->model('master_model');
	$unit= '';
	$id= '';
	if (!empty($cond)) {
		$CI->db->select("a.*");
		$CI->db->from('m_unit_kerja' . ' a');
		$CI->db->where_in('id',$cond);
		$query = $CI->db->get();
		if ($query->num_rows() > 0 )  {
			$total = 0;
			foreach ($query->result() as $key => $val) {
				$total += 1;
			}
		}
	}
	return $total;
}

function init_options($array_data, $key_index = null, $value_index = null, $default = '- Pilih -') {
	$result = null;

	$key_index = $key_index != null ? $key_index : 0;
	$value_index = $value_index != null ? $value_index : 1;
	if ($default) {
		$result .= '<option value="">'.$default.'</option>';
	}
	foreach ($array_data as $i => $row) {
		$result .= '<option value="' . $row[$key_index] . '" >' . $row[$value_index] . '</option>';
		// $result .= '<option value="' . $row[$key_index] . '" ' . ( $i == 0 ? 'selected' : '' ) . '>' . $row[$value_index] . '</option>';
	}

	return $result;
}

function indo_bulan($bulan){
	if ($bulan == 1) {
		return 'Januari';
	}elseif ($bulan == 2) {
		return 'Februari';
	}elseif ($bulan == 3) {
		return 'Maret';
	}elseif ($bulan == 4) {
		return 'April';
	}elseif ($bulan == 5) {
		return 'Mei';
	}elseif ($bulan == 6) {
		return 'Juni';
	}elseif ($bulan == 7) {
		return 'Juli';
	}elseif ($bulan == 8) {
		return 'Agustus';
	}elseif ($bulan == 9) {
		return 'September';
	}elseif ($bulan == 10) {
		return 'Oktober';
	}elseif ($bulan == 11) {
		return 'November';
	}else{
		return 'Desember';
	}
}

function indo_date($date)
{
    if (trim($date) != '' and $date != '0000-00-00') {
        $newdate = new DateTime($date);
        $pcs = explode("-", $date);
        $y = $newdate->format('Y');
        $m = $newdate->format('n');
        $d = $newdate->format('j');
        $wk = $newdate->format('w');

        $getbulan = array();
        $getbulan[1] = 'Januari';
        $getbulan[2] = 'Februari';
        $getbulan[3] = 'Maret';
        $getbulan[4] = 'April';
        $getbulan[5] = 'Mei';
        $getbulan[6] = 'Juni';
        $getbulan[7] = 'Juli';
        $getbulan[8] = 'Agustus';
        $getbulan[9] = 'September';
        $getbulan[10] = 'Oktober';
        $getbulan[11] = 'November';
        $getbulan[12] = 'Desember';

        $gethari = array();
        $gethari[0] = 'Minggu';
        $gethari[1] = 'Senin';
        $gethari[2] = 'Selasa';
        $gethari[3] = 'Rabu';
        $gethari[4] = 'Kamis';
        $gethari[5] = 'Jumat';
        $gethari[6] = 'Sabtu';

        return $gethari[$wk] . ", " . $d . " " . $getbulan[$m] . " " . $y;
    }
}

function indo_date_hour($date)
{
    if (trim($date) != '' and $date != '0000-00-00') {
        $newdate = new DateTime($date);
        $datehour = strtotime($date);
        $pcs = explode("-", $date);
        $y = $newdate->format('Y');
        $m = $newdate->format('n');
        $d = $newdate->format('j');
        $wk = $newdate->format('w');

        $getbulan = array();
        $getbulan[1] = 'Januari';
        $getbulan[2] = 'Februari';
        $getbulan[3] = 'Maret';
        $getbulan[4] = 'April';
        $getbulan[5] = 'Mei';
        $getbulan[6] = 'Juni';
        $getbulan[7] = 'Juli';
        $getbulan[8] = 'Agustus';
        $getbulan[9] = 'September';
        $getbulan[10] = 'Oktober';
        $getbulan[11] = 'November';
        $getbulan[12] = 'Desember';

        $gethari = array();
        $gethari[0] = 'Minggu';
        $gethari[1] = 'Senin';
        $gethari[2] = 'Selasa';
        $gethari[3] = 'Rabu';
        $gethari[4] = 'Kamis';
        $gethari[5] = 'Jumat';
        $gethari[6] = 'Sabtu';

        return $gethari[$wk] . " - " . $d . " " . $getbulan[$m] . " " . $y . " - " . date('H:i:s', $datehour);
    }
}

function indo_date_noday($date)
{
    if (trim($date) != '' and $date != '0000-00-00') {
        $newdate = new DateTime($date);
        $pcs = explode("-", $date);
        $y = $newdate->format('Y');
        $m = $newdate->format('n');
        $d = $newdate->format('j');
        $wk = $newdate->format('w');

        $getbulan = array();
        $getbulan[1] = 'Januari';
        $getbulan[2] = 'Februari';
        $getbulan[3] = 'Maret';
        $getbulan[4] = 'April';
        $getbulan[5] = 'Mei';
        $getbulan[6] = 'Juni';
        $getbulan[7] = 'Juli';
        $getbulan[8] = 'Agustus';
        $getbulan[9] = 'September';
        $getbulan[10] = 'Oktober';
        $getbulan[11] = 'November';
        $getbulan[12] = 'Desember';

        return $d . " " . $getbulan[$m] . " " . $y;
    }
}

function options_status($swit = '')
{

    if ($swit == 'color') {
        $data = array(
            '' => '',
            'D' => 'primary',
            'R' => 'warning',
            'S' => 'success',
            'X' => 'danger',
            'T' => 'warning',
            'P' => 'primary',
            'TL' => 'primary',
            'N' => 'danger',
            'BTL' => 'danger',
            'DTL' => 'warning',
            'STL' => 'success',
            'TDTL' => 'danger',
        );
    } else {
        $data = array(
            '' => '',
            'D' => 'Draft',
            'SD' => 'Draft',
            'R' => 'Review',
            'S' => 'Selesai',
            'X' => 'Ditolak',
            'T' => 'Ditolak',
            'P' => 'Assessment process',
            'TL' => 'Sedang ditindak lanjuti',
            'N' => 'Belum di set',
            'BTL' => 'Belum Ditindaklanjuti',
            'DTL' => 'Dalam Proses Tindak Lanjut',
            'STL' => 'Sudah Ditindaklanjuti',
            'TDTL' => 'Tidak Dapat Ditindaklanjuti',
            'nearmiss' => 'Near Miss',
            'softloss' => 'Soft Loss',
            'lossevent' => 'Loss Event',
            'potensialrisk' => 'Potential Risk',
        );
    }

    return $data;
}

function status_value($status = '', $data = '')
{
    $options_status = options_status($data);
    if ($status != '') {
        $status = (isset($options_status[$status]) ? $options_status[$status] : '');
    }
    return $status;
}

function options_group($where = '', $tabel = '', $id = '', $nama = '', $parent = '', $default = '', $key = '', $db = 'default')
{
    if ($where == '' || $where == null) {
        $where['(' . $parent . ' IS NULL or ' . $parent . ' = 0)'] = null;
    }

    $query = get_data($where, '', '', $tabel, $db);

    $data = array();
    $data1 = array();

    if ($default != '') {
        $data[$key] = $default;
    }

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $rp) {
            unset($where['(' . $parent . ' IS NULL or ' . $parent . ' = 0)']);
            $where[$parent] = $rp->$id;

            $cek_child = getCount($tabel, $where, null, $db);
            if ($cek_child > 0) {
                $query2 = get_data($where, '', '', $tabel, $db);
                if ($query2->num_rows() > 0) {
                    foreach ($query2->result() as $rp2) {
                        $data1[$rp->$nama][$rp2->$id] = $rp2->$nama;
                    }
                }
            } else {
                $data[$rp->$id] = $rp->$nama;
            }
        }
    }

    return $data + $data1;
}
function sendNotif($data)
{
		$CI = &get_instance();
		$CI->load->model('master_model');
		$input = $CI->master_model->save([
				'url' => isset($data['url']) ? $data['url'] : '',
				'role_id' => isset ( $data['role_id'] ) ? $data['role_id'] : null,
				'user_id' => isset ( $data['user_id'] ) ? $data['user_id'] : null ,
				'message' => $data['message'] != null ? $data['message'] : 'Keterangan Notifikasi',
				'title' => $data['title'] != null ? $data['title'] : 'Notifikasi',
				'modul' => $data['modul'] != null ? $data['modul'] : null,
				'st_viewed' => 0,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
				'action_to_do' => 'R',
				'kd_loker' => null,
				'action_reference' => null,
		], 't_notification');

		if ($input) {
				return true;
		}

		return false;
}

function updateNotifChat($data, $cond)
{
		$CI = &get_instance();
		$CI->load->model('master_model');
		$update = $CI->master_model->update($data, $cond, 't_notification');

		if ($update) {
				return true;
		}
		return false;
}

function setStatusNotif($idNotif, $statusNotif)
{
	$CI = &get_instance();
	$CI->load->model('master_model');
	$update = $CI->master_model->update(['st_viewed' => $statusNotif], ['id' => $idNotif], 't_notification');
}

function seenNotif($idNotif, $urlRedirect)
{
	setStatusNotif($idNotif, 1);

	echo json_encode(site_url($urlRedirect));
}

function closeNotif($idNotif, $urlRedirect)
{
	setStatusNotif($idNotif, 2);

	echo json_encode(site_url($urlRedirect));
}
