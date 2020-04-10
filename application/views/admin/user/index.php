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
    <h5 class="panel-title"><i class="icon-collaboration"></i> Manajemen Akses</h5>
  </div>
  <div class="panel-body">
  <div class="well well-sm">
    <div class="col-md-4">
      <?php echo form_open('User/add');?>
        <center>
           <select required data-placeholder="~~~ Pilih User ~~~" name="penduduk" class="select-clear">
              <option value=""></option>
              <?php $allpenduduk=$this->db->where('status',1)->get('penduduk')->result();
              $no=0; foreach($allpenduduk as $r): $no++;
               ?>
              <option value="<?php echo $r->nik; ?>"><?php echo $r->nama; ?></option>
            <?php endforeach; ?>
          </select>
        </center>
      </div>
      <div class="col-md-4">
        <center>
           <select required data-placeholder="~~~ Pilih Akses ~~~" name="akses" class="select-clear">
              <option value=""></option>
              <option value="1">Superadmin</option>
              <option value="2">Admin</option>
              
          </select>
        </center>
      </div>
      <div class="col-md-3">
        <center>
          <button type="submit" class="btn btn-primary btn-sm"><i class="icon-file-plus"></i> Tambah </button>
        </center>
      <?php echo form_close(); ?>
      </div>
      <?php echo br(2); ?>
  </div>
   <table class="table table-bordered datatable-columns">
      <thead>
          <tr>
              <th>Nomor</th>
              <th>Nama</th>
              <th>Akses</th>
              <th><center>Opsi</center></th>
              <th><center>Opsi</center></th>
          </tr>
      </thead>
      <tbody>
          <?php $no=0; foreach($all as $row): $no++; ?>
            <tr>
                <td></td>
                <td><?php echo getnama($row->id_penduduk); ?></td>
                <td><?php if($row->akses==1){echo "Superadmin";}else{echo "Admin";}; ?></td>
                <td><?php echo $no; ?></td>
                <td>
                  <center>
                    <a href="<?php echo site_url('User/reset/'.$row->id_admin); ?>" onclick="return confirm('Apakah Anda Mereser Data Ini');" class="btn btn-primary btn-xs tooltips" data-popup="tooltip" data-original-title="Reset Data" data-placement="top"><i class="icon-spinner3"></i></a>
                    <a href="<?php echo site_url('User/delete/'.$row->id_admin); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini');" class="btn btn-danger btn-xs tooltips" data-popup="tooltip" data-original-title="Hapus Data" data-placement="top"><i class="icon-x"></i></a>
                  </center>
                </td>
            </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>