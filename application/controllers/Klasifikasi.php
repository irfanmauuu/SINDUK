<?php

class Klasifikasi extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$config['tag_open'] = '<ul class="breadcrumb">';
		$config['tag_close'] = '</ul>';
		$config['li_open'] = '<li>';
		$config['li_close'] = '</li>';
		$config['divider'] = '<span class="divider"> » </span>';
		$this->breadcrumb->initialize($config);
		$this->load->model('M_klasifikasi');
		$this->load->helper('form');
		no_access();
		levelsuper();
	}
	public function index()
	{
		$data=array(
			"title"=>'Klasifikasi',
			"menu"=>getmenu(),
			"all"=>$this->db->get('klasifikasi')->result(),
			"aktif"=>"klasifikasi",
			"content"=>"klasifikasi/index.php",
		);
		$this->breadcrumb->append_crumb('Klasifikasi', site_url('klasifikasi'));
		$this->load->view('admin/template',$data);
	}
	public function add()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('klasifikasi', 'klasifikasi', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('klasifikasi');
		}else{
			$data=array(
				"id_klasifikasi"=>$_POST['id'],
				"klasifikasi"=>$_POST['klasifikasi'],
				"status"=>1,
			);
			$this->db->insert('klasifikasi',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('klasifikasi');
		}
	}
	public function edit()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('klasifikasi', 'klasifikasi', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Edit");
			redirect('klasifikasi');
		}else{
			$data=array(
				"klasifikasi"=>$_POST['klasifikasi'],
			);
			$this->db->where('id_klasifikasi', $_POST['id']);
			$this->db->update('klasifikasi',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
			redirect('klasifikasi');
		}
	}
	public function hapus($id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('klasifikasi');
		}else{
			$this->db->where('id_klasifikasi', $id);
			$this->db->delete('klasifikasi');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('klasifikasi');
		}
	}
	public function detail($id)
	{
		$getrow=$this->M_klasifikasi->getrow($id)->row_array();
		$data=array(
			"title"=>'Detail||Klasifikasi',
			"menu"=>getmenu(),
			"all"=>$this->db->where('id_klasifikasi',$id)->get('kategori_klasifikasi')->result(),
			"aktif"=>"klasifikasi",
			"kategori"=>$getrow['klasifikasi'],
			"id"=>$id,
			"content"=>"klasifikasi/detail.php",
		);
		$this->breadcrumb->append_crumb('Klasifikasi', site_url('klasifikasi'));
		$this->breadcrumb->append_crumb('Kategori Di Klasifikasi <strong><i>'.$getrow['klasifikasi'].'</i></strong>', site_url('klasifikasi/detail/'.$id));
		$this->load->view('admin/template',$data);
	}
	public function addkategori($id)
	{
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		$getrow=$this->M_klasifikasi->getnum($_POST['kategori'],$id)->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('klasifikasi/detail/'.$id);
		}elseif($getrow>0){
			$this->session->set_flashdata('error',"Data Sudah Ada");
			redirect('klasifikasi/detail/'.$id);
		}else{
			$data=array(
				"id_kategori"=>$_POST['kategori'],
				"id_klasifikasi"=>$id,
				"status"=>1,
			);
			$this->db->insert('kategori_klasifikasi',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('klasifikasi/detail/'.$id);
		}
	}
	public function hapuskategori($id_kategori,$id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('klasifikasi/detail/'.$id);
		}else{
			$data=array(
				"status"=>1
			);
			$this->db->where('id_klasifikasi',$id);
			$this->db->where('id_kategori',$id_kategori);
			$this->db->delete('kategori_klasifikasi');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('klasifikasi/detail/'.$id);
		}
	}
}
