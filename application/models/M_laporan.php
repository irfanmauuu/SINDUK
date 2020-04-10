<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function all()
	{
		$agama=$_POST['agama'];
		$jk=$_POST['jk'];
		$status=$_POST['status'];
		if($agama!=""){
			$and="AND penduduk.id_agama='$agama'";
		}else{
			$and="";
		}
		if($jk!=""){
			$and1="AND jk='$jk'";
		}else{
			$and1="";
		}
		if($status!=""){
			$and2="AND penduduk.status='$status'";
		}else{
			$and2="";
		}
		$q= $this->db->query("SELECT * FROM penduduk 
							JOIN agama ON agama.id_agama=penduduk.id_agama
							WHERE penduduk.nik!=''
							".$and." ".$and1." ".$and2."
							");
		return $q->result();	
	}
}

/* End of file M_laporan.php */
/* Location: ./application/models/M_laporan.php */