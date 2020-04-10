<?php

class Welcome extends CI_Controller {
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
	}
	public function index()
	{
		$data=array(
			"title"=>'Dashboard',
			"menu"=>getmenu(),
			"aktif"=>"dashboard",
			"content"=>"dashboard/index.php",
		);
		$this->breadcrumb->append_crumb('Dashboard', site_url('welcome'));
		$this->load->view('admin/templatedash',$data);
	}
	public function embed($file)
	{
		echo "<embed src='".base_url('uploads/'.$file)."' width='100%' height='100%'></embed>";
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('id_penduduk');
		$this->session->unset_userdata('level');
		$this->session->set_flashdata('sukses', 'Terimakasih Telah Menggunakan Aplikasi Sipudes');
		redirect('login');
	}
	public function update()
	{
		$passlama=$_POST['passlama'];
		$userlama=$_POST['userlama'];
		$user=$_POST['username'];
		$password=$_POST['password'];
		$passwordbaru=$_POST['password_baru'];
		$konfbaru=$_POST['konf_baru'];
		$arr=$this->db->query("select * from admin where username='$userlama'")->row_array();
		$cek=$this->db->query("select * from admin where username='$user'")->num_rows();
		if($userlama!=$user){
			if($cek>0){
				$this->session->set_flashdata('error', 'Maaf Username Sudah Di Gunakan');
				redirect('welcome');
			}elseif(md5($password)!=$arr['password']){
				$this->session->set_flashdata('error', 'Maaf Password Lama Anda Salah');
				redirect('welcome');
			}elseif($passwordbaru!=$konfbaru){
				$this->session->set_flashdata('error', 'Maaf Konfirmasi Password Tidak Sama');
				redirect('welcome');
			}elseif($passlama!=md5($passwordbaru)){
				$data=array(
					"username"=>$user,
					"password"=>md5($passwordbaru),
				);
			}else{
				$data=array(
					"username"=>$user,
					"password"=>md5($passwordbaru),
				);
			}
		}elseif(md5($password)!=$arr['password']){
			$this->session->set_flashdata('error', 'Maaf Password Lama Anda Salah');
			redirect('welcome');
		}elseif($passwordbaru!=$konfbaru){
			$this->session->set_flashdata('error', 'Maaf Konfirmasi Password Tidak Sama');
			redirect('welcome');
		}elseif($passlama!=md5($passwordbaru)){
			$data=array(
				"username"=>$user,
				"password"=>md5($passwordbaru),
			);
		}else{
			$data=array(
				"username"=>$user,
				"password"=>md5($passwordbaru),
			);
		}
		$this->db->where('username', $userlama);
		$this->db->update('admin', $data);
		$this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
		redirect('welcome');
	}
}
