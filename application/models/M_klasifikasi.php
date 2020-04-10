<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_klasifikasi extends CI_Model {

	public function getrow($id)
	{
		return $this->db->query("select * from klasifikasi where id_klasifikasi='$id'");
	}
	public function getrowkategori($id)
	{
		return $this->db->query("select * from kategori where id_kategori='$id'");
	}
	public function getnum($id,$idklas)
	{
		return $this->db->query("select * from kategori_klasifikasi where id_kategori='$id' and id_klasifikasi='$idklas'");
	}
}

/* End of file M_klasifikasi.php */
/* Location: ./application/models/M_klasifikasi.php */