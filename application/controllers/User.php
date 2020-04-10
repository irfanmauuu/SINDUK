<?php

class User extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$config['tag_open'] = '<ul class="breadcrumb">';
		$config['tag_close'] = '</ul>';
		$config['li_open'] = '<li>';
		$config['li_close'] = '</li>';
		$config['divider'] = '<span class="divider"> » </span>';
		$this->breadcrumb->initialize($config);
		no_access();
		levelsuper();
	}
	public function index()
	{
		$data=array(
			"title"=>'Manajemen Akses',
			"menu"=>getmenu(),
			"all"=>$this->db->get('admin')->result(),
			"aktif"=>"user",
			"content"=>"user/index.php",
		);
		$this->breadcrumb->append_crumb('User', site_url('user'));
		$this->load->view('admin/template',$data);
	}
	public function add()
	{
		$id=$_POST['penduduk'];
		$cek=$this->db->query("SELECT * FROM admin where id_penduduk='$id'")->num_rows();
		if($cek>0){
			$this->session->set_flashdata('error', 'User Sudah Memiliki Akses Di Aplikasi');
			redirect('User');
		}else{
			$object=array(
				"id_admin"=>"",
				"username"=>$id,
				"id_penduduk"=>$id,
				"password"=>md5($id),
				"akses"=>$_POST['akses'],
				"status"=>1
			);
			$this->db->insert('admin', $object);
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambahkan');
			redirect('User');
		}
		
	}
	public function reset($id)
	{
		$cek=$this->db->query("SELECT * FROM admin where id_admin='$id'")->row_array();
		
		$object=array(
			"username"=>$cek['id_penduduk'],
			"password"=>md5($cek['id_penduduk']),
		);
		$this->db->where('id_admin', $id);
		$this->db->update('admin', $object);
		$this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
		redirect('User');
	}
	public function delete($id)
	{
		$this->db->query("DELETE FROM admin where id_admin='$id'");
		$this->session->set_flashdata('sukses', 'Data Berhasil Di Hapus');
		redirect('User');
	}
}
