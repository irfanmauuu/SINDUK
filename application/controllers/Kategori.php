<?php

class Kategori extends CI_Controller {
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
			"title"=>'Kategori',
			"menu"=>getmenu(),
			"all"=>$this->db->get('kategori')->result(),
			"aktif"=>"kategori",
			"content"=>"kategori/index.php",
		);
		$this->breadcrumb->append_crumb('Kategori', site_url('kategori'));
		$this->load->view('admin/template',$data);
	}
	public function add()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('Kategori');
		}else{
			$data=array(
				"id_kategori"=>$_POST['id'],
				"kategori"=>$_POST['kategori'],
				"status"=>1,
			);
			$this->db->insert('kategori',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('Kategori');
		}
	}
	public function edit()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Edit");
			redirect('Kategori');
		}else{
			$data=array(
				"kategori"=>$_POST['kategori'],
			);
			$this->db->where('id_kategori', $_POST['id']);
			$this->db->update('kategori',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
			redirect('Kategori');
		}
	}
	public function hapus($id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('Kategori');
		}else{
			$this->db->where('id_kategori', $id);
			$this->db->delete('kategori');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('Kategori');
		}
	}
}
