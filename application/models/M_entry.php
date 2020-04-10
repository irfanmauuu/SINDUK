<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_entry extends CI_Model {

	public function getkategori($id)
	{
	return	$this->db->query("SELECT distinct kategori.id_kategori,kategori.kategori FROM klasifikasi_penduduk
						JOIN kategori_klasifikasi ON klasifikasi_penduduk.id_klasifikasi=kategori_klasifikasi.id_klasifikasi
						JOIN kategori ON kategori.id_kategori=kategori_klasifikasi.id_kategori
						AND klasifikasi_penduduk.nik='$id'");
	}

}

/* End of file M_entry.php */
/* Location: ./application/models/M_entry.php */