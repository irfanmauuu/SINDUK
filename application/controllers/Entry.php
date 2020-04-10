<?php 
class Entry extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$config['tag_open'] = '<ul class="breadcrumb">';
		$config['tag_close'] = '</ul>';
		$config['li_open'] = '<li>';
		$config['li_close'] = '</li>';
		$config['divider'] = '<span class="divider"> » </span>';
		$this->breadcrumb->initialize($config);
		$this->load->model('M_entry');
		no_access();
	}
	public function index()
	{
		$data=array(
			"title"=>'Entri Data',
			"menu"=>getmenu(),
			"all"=>$this->db->get('kk')->result(),
			"aktif"=>"entry",
			"content"=>"entry/index.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function addkk()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('no_kk', 'no_kk', 'required');
		$this->form_validation->set_rules('rt', 'rt', 'required');
		$this->form_validation->set_rules('rw', 'rw', 'required');
		$id=$_POST['no_kk'];
		$cek=$this->db->query("select * from kk where no_kk='$id'")->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('entry');
		}elseif($cek>0){
			$this->session->set_flashdata('error',"No KK Sudah Digunakan");
			redirect('entry');
		}else{
			$data=array(
				"id_kk"=>$_POST['id'],
				"no_kk"=>$_POST['no_kk'],
				"rt"=>$_POST['rt'],
				"rw"=>$_POST['rw'],
				"kk"=>"",
				"status"=>1,
			);
			$this->db->insert('kk',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('entry');
		}
	}
	public function hapus($id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('Entry');
		}else{
			$this->db->where('id_kk', $id);
			$this->db->delete('kk');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('Entry');
		}
	}
	public function editkk($id)
	{
		$data=array(
			"title"=>'Edit KK||Entri Data',
			"menu"=>getmenu(),
			"getrow"=>$this->db->where('id_kk',$id)->get('kk')->row_array(),
			"aktif"=>"entry",
			"id"=>$id,
			"content"=>"entry/editkk.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->breadcrumb->append_crumb('Edit Data KK <i>'.getnamakk($id).'</i>', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function editkkprocess()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('no_kk', 'no_kk', 'required');
		$this->form_validation->set_rules('rt', 'rt', 'required');
		$this->form_validation->set_rules('rw', 'rw', 'required');
		$id=$_POST['id'];
		$cek=$this->db->query("select * from kk where no_kk='$id'")->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Edit");
			redirect('entry/editkk/'.$id);
		}elseif($cek>0){
			$this->session->set_flashdata('error',"No KK Sudah Digunakan");
			redirect('entry/editkk/'.$id);
		}else{
			$data=array(
				"no_kk"=>$_POST['no_kk'],
				"rt"=>$_POST['rt'],
				"rw"=>$_POST['rw'],
			);
			$this->db->where('id_kk', $id);
			$this->db->update('kk',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
			redirect('entry/editkk/'.$id);
		}
	}
	public function detailkk($id)
	{
		$data=array(
			"title"=>'Detail KK||Entri Data',
			"menu"=>getmenu(),
			"all"=>$this->db->where('id_kk',$id)->get('penduduk')->result(),
			"aktif"=>"entry",
			"id"=>$id,
			"content"=>"entry/detail.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->breadcrumb->append_crumb('Data Individu KK <i>'.getnamakk($id).'</i>', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function addindividu($id)
	{
		$data=array(
			"title"=>'Tambah Individu||Detail KK||Entri Data',
			"menu"=>getmenu(),
			"aktif"=>"entry",
			"id"=>$id,
			"content"=>"entry/addindividu.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->breadcrumb->append_crumb('Data Individu KK <i>'.getnamakk($id).'</i>', site_url('entry/detailkk/'.$id));
		$this->breadcrumb->append_crumb('Tambah Individu KK', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function addprocessin()
	{
		$this->form_validation->set_rules('no_kk', 'no_kk', 'required');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('jk', 'jk', 'required');
		$this->form_validation->set_rules('golongan_darah', 'golongan_darah', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'required');
		$this->form_validation->set_rules('agama', 'agama', 'required');
		$id=$_POST['nik'];
		$cek=$this->db->query("select * from penduduk where nik='$id'")->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('entry/addindividu/'.$_POST['no_kk']);
		}elseif($cek>0){
			$this->session->set_flashdata('error',"NIK Sudah Digunakan");
			redirect('entry/addindividu/'.$_POST['no_kk']);
		}else{
			$foto=$_FILES['gambar']['name'];
			$dir		= "upload/";
			$dir1		= "uploads/";
			if($_FILES['gambar']['name']!=""){
				$file='gambar'; //name pada input type file
				$filename 	= $_FILES['gambar']['name'];
				$dir		= "upload/";
				$dir1		= "uploads/";
				$file		= 'gambar';
				$new_name='uploadfoto'.date('YmdHis').$_POST['nik']; //name pada input type file
				$tipe 		= $_FILES['gambar']['type'];
				$ukuran 	= $_FILES['gambar']['size'];
				$vdir_upload	= $dir;
				$file_name		= $_FILES[''.$file.'']["name"];
				$vfile_upload	= $vdir_upload.$file;
				$tmp_file		= $_FILES[''.$file.'']["tmp_name"];
				move_uploaded_file ($tmp_file, $dir.$file_name);
				date_default_timezone_get('Asia/Jakarta');
				$source_url=$dir.$file_name;
				$info=getimagesize($source_url);
				if ($ukuran < 300000 and $ukuran > 10000) {	
					$quality=100;
				}
				elseif ($ukuran < 1000000 and $ukuran > 300000) {	
					$quality=70;
				}
				elseif ($ukuran < 1500000 and $ukuran > 1000000) {	
					$quality=50;
				}
				elseif ($ukuran < 2000000 and $ukuran > 1000000) {	
					$quality=40;
				}
				elseif ($ukuran < 2500000 and $ukuran > 2000000) {	
					$quality=30;
				}
				elseif ($ukuran < 3000000 and $ukuran > 2500000) {	
					$quality=20;
				}
				elseif ($ukuran > 3000000) {	
					$quality=10;
				}else{
					$quality=10;
				}
				$gambar = imagecreatefromjpeg($source_url);
				$ext='.jpeg';
				if (imagejpeg($gambar, $dir1.$new_name.$ext, $quality)){
					unlink($source_url);
				}else{
					unlink($source_url);
				}
			}else{
				$new_name="";
				$ext="";
			}
			$data=array(
				"nik"=>$_POST['nik'],
				"nama"=>strtoupper($_POST['nama']),
				"tempat_lahir"=>strtoupper($_POST['tempat']),
				"tanggal_lahir"=>$_POST['tanggal'],
				"jk"=>$_POST['jk'],
				"golongan_darah"=>$_POST['golongan_darah'],
				"alamat"=>strtoupper($_POST['alamat']),
				"pekerjaan"=>strtoupper($_POST['pekerjaan']),
				"kewarganegaraan"=>$_POST['kewarganegaraan'],
				"id_agama"=>$_POST['agama'],
				"id_kk"=>$_POST['no_kk'],
				"foto"=>$new_name.$ext,
				"status"=>1,
			);
			$this->db->insert('penduduk',$data);
			for ($i=0; $i < count($_POST['klasifikasi']); $i++) { 
				$objek=array(
					"nik"=>$_POST['nik'],
					"id_klasifikasi"=>$_POST['klasifikasi'][$i],
				);
				$this->db->insert('klasifikasi_penduduk', $objek);
			}
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('entry/detailkk/'.$_POST['no_kk']);
		}
	}
	public function kk($id)
	{
		$kk=getKK($id);
		if($id==""){
			$this->session->set_flashdata('error',"Data Gagal Di Update");
			redirect('entry/detailkk/'.$kk);
		}else{
			$data=array(
				"kk"=>$id,
			);
			$this->db->where('id_kk', $kk);
			$this->db->update('kk',$data);
			$this->session->set_flashdata('sukses', getnama($id)." Berhasil Di Jadikan Kepala Keluarga");
			redirect('entry/detailkk/'.$kk);
		}
	}
	public function detailindividu($id)
	{
		$kk=getKK($id);
		$data=array(
			"title"=>'Detail Individu||Detail KK||Entri Data',
			"menu"=>getmenu(),
			"aktif"=>"entry",
			"id"=>$id,
			"getrow"=>$this->db->where('nik', $id)->get('penduduk')->row_array(),
			"getklasifikasi"=>$this->M_entry->getKategori($id)->result(),
			"content"=>"entry/detailindividu.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->breadcrumb->append_crumb('Data Individu KK <i>'.getnamakk($kk).'</i>', site_url('entry/detailkk/'.$kk));
		$this->breadcrumb->append_crumb('Detail Individu <i>'.getnama($id).'</i>', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function editfile()
	{
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error', "Data Gagal Disimpan");
			redirect('entry/detailindividu/'.$_POST['nik']);
		}else{
			if($_FILES['gambar']['name']!=""){
				$stnk=$_FILES['gambar']['name'];
				$dir="upload/"; //tempat upload foto
				$dirs="uploads/"; //tempat upload foto
				$file='gambar'; //name pada input type file
				$new_name3='update'.date('YmdHis').$this->input->post('kategori').$this->input->post('nik').'.pdf'; //name pada input type file
				$vdir_upload = $dir;
				$file_name=$_FILES[''.$file.'']["name"];
				$vfile_upload = $vdir_upload . $file;
				$tmp_name=$_FILES[''.$file.'']["tmp_name"];
				move_uploaded_file($tmp_name, $dirs.$file_name);
				$source_url3=$dir.$file_name;
				rename($dirs.$file_name,$dirs.$new_name3);
				if($this->input->post('gambar_lama', TRUE)!=""){
					unlink("uploads/".$this->input->post('gambar_lama', TRUE));
				}
			}else{
				$new_name3=$this->input->post('gambar_lama', TRUE);
			}
			$data=array(
				"id_kategori"=>$_POST['kategori'],
				"nik"=>$_POST['nik'],
				"file"=>$new_name3,
				"status"=>1
			);
			if($this->input->post('gambar_lama')==""){
				$this->db->insert('file', $data);
				$this->session->set_flashdata('sukses', "File Berhasil Disimpan");
				redirect('entry/detailindividu/'.$_POST['nik']);
			}else{
				$this->db->where('nik', $_POST['nik']);
				$this->db->where('id_kategori', $_POST['kategori']);
				$this->db->update('file', $data);
				$this->session->set_flashdata('sukses', "File Berhasil Diupdate");
				redirect('entry/detailindividu/'.$_POST['nik']);
			}
			
		}
	}
	public function hapusfile($nik,$kategori,$file)
	{
		if($nik=="" or $kategori=="" or $file==""){
			$this->session->set_flashdata('error', "File Gagal Dihapus");
			redirect('entry/detailindividu/'.$nik);
		}else{
			unlink("uploads/".$file);
			$this->db->where('nik', $nik);
			$this->db->where('id_kategori', $kategori);
			$this->db->delete('file');
			$this->session->set_flashdata('sukses', "File Berhasil Dihapus");
			redirect('entry/detailindividu/'.$nik);
		}
	}
	public function editindividu($id)
	{
		$kk=getKK($id);
		$data=array(
			"title"=>'Edit Individu||Detail KK||Entri Data',
			"menu"=>getmenu(),
			"aktif"=>"entry",
			"getrow"=>$this->db->where('nik',$id)->get('penduduk')->row_array(),
			"id"=>$id,
			"content"=>"entry/editindividu.php",
		);
		$this->breadcrumb->append_crumb('Entri Data KK', site_url('entry'));
		$this->breadcrumb->append_crumb('Data Individu KK <i>'.getnamakk($kk).'</i>', site_url('entry/detailkk/'.$kk));
		$this->breadcrumb->append_crumb('Edit Individu <i>'.getnama($id).'</i>', site_url('entry'));
		$this->load->view('admin/template',$data);
	}
	public function editprocessin()
	{
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('jk', 'jk', 'required');
		$this->form_validation->set_rules('golongan_darah', 'golongan_darah', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'required');
		$this->form_validation->set_rules('agama', 'agama', 'required');
		$id=$_POST['nik'];
		$cek=$this->db->query("select * from penduduk where nik='$id'")->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('entry/editindividu/'.$_POST['nik']);
		}else{
			$foto=$_FILES['gambar']['name'];
			$dir		= "upload/";
			$dir1		= "uploads/";
			if($_FILES['gambar']['name']!=""){
				$file='gambar'; //name pada input type file
				$filename 	= $_FILES['gambar']['name'];
				$dir		= "upload/";
				$dir1		= "uploads/";
				$file		= 'gambar';
				$new_name='uploadfoto'.date('YmdHis').$_POST['nik']; //name pada input type file
				$tipe 		= $_FILES['gambar']['type'];
				$ukuran 	= $_FILES['gambar']['size'];
				$vdir_upload	= $dir;
				$file_name		= $_FILES[''.$file.'']["name"];
				$vfile_upload	= $vdir_upload.$file;
				$tmp_file		= $_FILES[''.$file.'']["tmp_name"];
				move_uploaded_file ($tmp_file, $dir.$file_name);
				date_default_timezone_get('Asia/Jakarta');
				$source_url=$dir.$file_name;
				$info=getimagesize($source_url);
				if ($ukuran < 300000 and $ukuran > 10000) {	
					$quality=100;
				}
				elseif ($ukuran < 1000000 and $ukuran > 300000) {	
					$quality=70;
				}
				elseif ($ukuran < 1500000 and $ukuran > 1000000) {	
					$quality=50;
				}
				elseif ($ukuran < 2000000 and $ukuran > 1000000) {	
					$quality=40;
				}
				elseif ($ukuran < 2500000 and $ukuran > 2000000) {	
					$quality=30;
				}
				elseif ($ukuran < 3000000 and $ukuran > 2500000) {	
					$quality=20;
				}
				elseif ($ukuran > 3000000) {	
					$quality=10;
				}else{
					$quality=10;
				}
				$gambar = imagecreatefromjpeg($source_url);
				$ext='.jpeg';
				if (imagejpeg($gambar, $dir1.$new_name.$ext, $quality)){
					unlink($source_url);
				}else{
					unlink($source_url);
				}
				unlink("uploads/".$_POST['fotohidden']);
			}else{
				$new_name=$_POST['fotohidden'];
				$ext="";
			}
			$data=array(
				"nama"=>strtoupper($_POST['nama']),
				"tempat_lahir"=>strtoupper($_POST['tempat']),
				"tanggal_lahir"=>$_POST['tanggal'],
				"jk"=>$_POST['jk'],
				"golongan_darah"=>$_POST['golongan_darah'],
				"alamat"=>strtoupper($_POST['alamat']),
				"pekerjaan"=>strtoupper($_POST['pekerjaan']),
				"kewarganegaraan"=>$_POST['kewarganegaraan'],
				"id_agama"=>$_POST['agama'],
				"foto"=>$new_name.$ext,
				"status"=>1,
			);
			$this->db->where('nik',$_POST['nik']);
			$this->db->update('penduduk',$data);
			$this->db->where('nik', $_POST['nik']);
			$this->db->delete('klasifikasi_penduduk');
			for ($i=0; $i < count($_POST['klasifikasi']); $i++) { 
				$objek=array(
					"nik"=>$_POST['nik'],
					"id_klasifikasi"=>$_POST['klasifikasi'][$i],
				);
				$this->db->insert('klasifikasi_penduduk', $objek);
			}
			$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
			redirect('entry/editindividu/'.$_POST['nik']);
		}
	}
	public function hapusindividu($nik)
	{
		$kk=getKK($nik);
		$getrow=$this->db->query("select * from penduduk where nik='$nik'")->row_array();
		$getfile=$this->db->query("select * from file where nik='$nik'")->result();
		$this->db->query("delete from klasifikasi_penduduk where nik='$nik'");
		$this->db->where('nik', $nik);
		$this->db->delete('penduduk');
		unlink("uploads/".$getrow['foto']);
		foreach ($getfile as $row) {
			unlink("uploads/".$row->file);
		}
		$this->db->query("delete from file where nik='$nik'");
		$data=array(
			"kk"=>"",
		);
		$this->db->where('kk', $nik);
		$this->db->update('kk', $data);
		$this->session->set_flashdata('sukses', "Seluruh Data Individu Berhasil Dihapus");
		redirect('entry/detailkk/'.$kk);
	}
	public function deadindividu($nik)
	{
		$kk=getKK($nik);
		$data=array(
			"kk"=>"",
		);
		$data2=array(
			"status"=>2,
		);
		$this->db->where('kk', $nik);
		$this->db->update('kk', $data);
		$this->db->where('nik', $nik);
		$this->db->update('penduduk', $data2);
		$this->session->set_flashdata('sukses', "Data Berhasil Dinonaktifkan");
		redirect('entry/detailkk/'.$kk);
	}
	public function onindividu($nik)
	{
		$kk=getKK($nik);
		$data2=array(
			"status"=>1,
		);
		$this->db->where('nik', $nik);
		$this->db->update('penduduk', $data2);
		$this->session->set_flashdata('sukses', "Data Berhasil Diaktifkan");
		redirect('entry/detailkk/'.$kk);
	}
	public function all()
	{
		$data=array(
			"title"=>'Searching',
			"menu"=>getmenu(),
			"all"=>$this->db->query("SELECT * FROM penduduk 
									JOIN agama ON agama.id_agama=penduduk.id_agama")->result(),
			"aktif"=>"all",
			"content"=>"entry/all.php",
		);
		$this->breadcrumb->append_crumb('Searching', site_url('entry/all'));
		$this->load->view('admin/template',$data);
	}
}