<?php 
function in_access()
{
    $ci=& get_instance();
    if($ci->session->userdata('user')){
        redirect('welcome');
    }
}
function no_access()
{
    $ci=& get_instance();
    if(!$ci->session->userdata('user')){
        redirect('login');
    }
}
function menuaktif($aktif,$menu){	
	if($aktif==$menu){
		return "active";
	}else{
		return "";
	}
}
function getmenu(){	
    $CI =& get_instance();
	if($CI->session->userdata('level')==1){
        return "menu.php";
    }else{
        return "menuadmin.php";
    }
}
function levelsuper(){ 
    $CI =& get_instance();
    if($CI->session->userdata('level')!=1){
        $CI->session->set_flashdata('error', "Anda Tidak Memiliki Akses Pada Halaman Tersebut");
        redirect('Welcome');
    }
}
function getId($tabel,$id)
{
	$ci=& get_instance();
    $q = $ci->db->query("select MAX(".$id.") as kd_max from ".$tabel."");
    $kd = "";
    if($q->num_rows()>0)
    {
        foreach($q->result() as $k)
        {
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%09s", $tmp);
        }
    }
    else
    {
        $kd = "000000001";
    }
    return $kd;
}
function getnumkat($id)
{
	$ci=& get_instance();
    $q = $ci->db->query("select * from kategori_klasifikasi where id_klasifikasi='$id'")->num_rows();
    return $q;
}
function getnama($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from penduduk where nik='$id'")->row_array();
    return $q['nama'];
}
function getfoto($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from penduduk where nik='$id'")->row_array();
    return $q['foto'];
}
function getnamakk($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from kk where id_kk='$id'")->row_array();
    return $q['no_kk'];
}
function cekKK($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from kk where kk='$id'")->num_rows();
    return $q;
}
function getKK($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from penduduk where nik='$id'")->row_array();
    return $q['id_kk'];
}
function getnamaagama($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from agama where id_agama='$id'")->row_array();
    return $q['agama'];
}
function getnamaklasifikasi($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from klasifikasi where id_klasifikasi='$id'")->row_array();
    return $q['klasifikasi'];
}
function getfile($id,$nik)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from file where id_kategori='$id' and nik='$nik'")->num_rows();
    return $q;
}
function getnamafile($id,$nik)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from file where id_kategori='$id' and nik='$nik'")->row_array();
    return $q['file'];
}
function select($id,$id2)
{
    if($id==$id2){
        return "selected";
    }
}
function select2($klasifikasi,$nik)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from klasifikasi_penduduk where id_klasifikasi='$klasifikasi' and nik='$nik'")->num_rows();
    if($q>0){
        return "selected";
    }
}
function getnamains($nama)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from desa")->row_array();
    return $q[$nama];
    
}
function getjumagama($agama)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from penduduk where id_agama='$agama'")->num_rows();
    return $q;
    
}
function getjumstatus($s)
{
    $ci=& get_instance();
    $q = $ci->db->query("select * from penduduk where status='$s'")->num_rows();
    return $q;
    
}