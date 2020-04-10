<div class="panel panel-primary">
  <div class="panel-heading">
    <h5 class="panel-title"><i class="icon-pencil7"></i> Detail Individu <b><i><?=getnama($id);?></i></b></h5>
  </div>
  <div class="panel-body">
    <div class="col-md-6">
      <table class="table table-bordered">
          <tr>
              <th width="180">NIK</th>
              <td><?php echo $getrow['nik']; ?></td>
          </tr>
          <tr>
              <th>Nama</th>
              <td><?php echo $getrow['nama']; ?></td>
          </tr>
          <tr>
              <th>Tempat Lahir</th>
              <td><?php echo $getrow['tempat_lahir']; ?></td>
          </tr>
           <tr>
              <th>Tanggal Lahir</th>
              <td><?php echo $getrow['tanggal_lahir']; ?></td>
          </tr>
           <tr>
              <th>Jenis Kelamin</th>
              <td><?php echo $getrow['jk']; ?></td>
          </tr>
          <tr>
              <th>Golongan Darah</th>
              <td><?php echo $getrow['golongan_darah']; ?></td>
          </tr>
      </table>
    </div>
    <div class="col-md-6">
      <table class="table table-bordered">
          <tr>
              <th width="180">Alamat</th>
              <td><?php echo $getrow['alamat']; ?></td>
          </tr>
          <tr>
              <th>Pekerjaan</th>
              <td><?php echo $getrow['pekerjaan']; ?></td>
          </tr>
          <tr>
              <th>Kewarganegaraan</th>
              <td><?php echo $getrow['kewarganegaraan']; ?></td>
          </tr>
           <tr>
              <th>Agama</th>
              <td><?php echo getnamaagama($getrow['id_agama']); ?></td>
          </tr>
           <tr>
              <th>Foto</th>
              <td><img src="<?php echo base_url('uploads/'.$getrow['foto']); ?>" alt="Belum Di Update" class='img4'></td>
          </tr>
      </table>
    </div>
  </div>
</div>
<br>
<?php 
$data=$this->session->flashdata('sukses');
if($data!=""){ ?>
<div class="alert alert-success"><strong>Sukses! </strong> <?=$data;?></div>
<?php } ?>
<?php 
$data2=$this->session->flashdata('error');
if($data2!=""){ ?>
<div class="alert alert-danger"><strong> Error! </strong> <?=$data2;?></div>
<?php } ?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h5 class="panel-title"><i class="icon-pencil7"></i> Data File Di Individu <b><i><?=getnama($id);?></i></b></h5>
  </div>
  <div class="panel-body">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>File</th>
        <th><center>Opsi</center></th>
      </tr>
      <?php $no=0; foreach($getklasifikasi as $row): $no++ ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row->kategori; ?></td>
        <td>
          <?php if(getfile($row->id_kategori,$id)==""){
              echo '<i>Belum Di Update</i>';
            }else{?>
              <button onclick='open("<?php echo site_url('Welcome/embed/'.getnamafile($row->id_kategori,$id));?>","displayWindow","width=700,height=600,status=no,toolbar=no,menubar=no,left=355"); ' class="btn btn-md btn-primary" data-popup="tooltip" data-original-title="Lihat File" data-placement="top"><i class="icon-file-eye"></i> Lihat File</button>
           <?php } ?>
        </td>
        <td>
          <center>
            <a data-toggle="modal" data-target="#modal_edit<?=$no;?>" class="btn btn-info btn-xs tooltips" data-popup="tooltip" data-original-title="Update File" data-placement="top"><i class="icon-pencil5"></i></a>
            <a href="<?php echo site_url('entry/hapusfile/'.$id.'/'.$row->id_kategori.'/'.getnamafile($row->id_kategori,$id)); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini');" class="btn btn-danger btn-xs tooltips" data-popup="tooltip" data-original-title="Hapus Data" data-placement="top"><i class="icon-x"></i></a>
          </center>
        </td>
      </tr>
    <?php endforeach; ?>
    </table>
  </div>
</div>
<?php $n=0; foreach($getklasifikasi as $ro): $n++; ?>
<div class="row">
  <div id="modal_edit<?=$n;?>" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo site_url('entry/editfile'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title"><strong>Update File <?php echo $ro->kategori; ?></strong></h6>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class='col-md-3'>File(Baru)</label>
            <div class='col-md-9'><input type="file" required name="gambar" accept="application/pdf" class="form-control" ></div>
          </div>
          <br>
          <input type="hidden" value="<?php echo $id; ?>" name="nik">
          <input type="hidden" value="<?php echo $ro->id_kategori; ?>" name="kategori">
          <input type="hidden" value="<?php echo getnamafile($ro->id_kategori,$id); ?>" name="gambar_lama">
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning"><i class="icon-pencil5"></i> Edit</button>
          </div>
        </form>
    </div>
  </div>
</div>
<?php endforeach; ?>