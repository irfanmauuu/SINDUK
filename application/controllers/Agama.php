<?php

class Agama extends CI_Controller {
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
			"title"=>'Agama',
			"menu"=>getmenu(),
			"all"=>$this->db->get('agama')->result(),
			"aktif"=>"agama",
			"content"=>"agama/index.php",
		);
		$this->breadcrumb->append_crumb('Agama', site_url('agama'));
		$this->load->view('admin/template',$data);
	}
	public function add()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('agama', 'agama', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('Agama');
		}else{
			$data=array(
				"id_agama"=>$_POST['id'],
				"agama"=>$_POST['agama'],
				"status"=>1,
			);
			$this->db->insert('agama',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('Agama');
		}
	}
	public function edit()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('agama', 'agama', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Edit");
			redirect('Agama');
		}else{
			$data=array(
				"agama"=>$_POST['agama'],
			);
			$this->db->where('id_agama', $_POST['id']);
			$this->db->update('agama',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
			redirect('Agama');
		}
	}
	public function hapus($id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('Agama');
		}else{
			$this->db->where('id_agama', $id);
			$this->db->delete('agama');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('Agama');
		}
	}
}
