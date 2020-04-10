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
    <h5 class="panel-title"><i class="icon-upload7"></i> Kategori Di Klasifikasi <b><i><?=$kategori;?></i></b></h5>
  </div>
  <div class="panel-body">
  <div class="well well-sm">
    <div class="col-md-9">
      <?php echo form_open('Klasifikasi/addkategori/'.$id);?>
        <center>
           <select required data-placeholder="~~~ Pilih Kategori ~~~" name="kategori" class="select-clear">
              <option value=""></option>
              <?php $allkat=$this->db->get('kategori')->result();
              $no=0; foreach($allkat as $r): $no++;
               ?>
              <option value="<?php echo $r->id_kategori; ?>"><?php echo $r->kategori; ?></option>
            <?php endforeach; ?>
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
              <th>Kategori</th>
              <th><center>Opsi</center></th>
          </tr>
      </thead>
      <tbody>
          <?php $no=0; foreach($all as $row): $no++; ?>
            <tr>
                <?php $getrow=$this->M_klasifikasi->getrowkategori($row->id_kategori)->row_array(); ?>
                <td></td>
                <td><?php echo $getrow['kategori']; ?></td>
                <td>
                  <center>
                    <a href="<?php echo site_url('Klasifikasi/hapuskategori/'.$row->id_kategori.'/'.$id); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini');" class="btn btn-danger btn-xs tooltips" data-popup="tooltip" data-original-title="Hapus Data" data-placement="top"><i class="icon-x"></i></a>
                  </center>
                </td>
                <td><?php echo $no; ?></td>
            </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>