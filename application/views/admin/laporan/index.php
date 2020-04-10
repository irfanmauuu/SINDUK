<div class="panel panel-primary">
  <div class="panel-heading">
    <h9 class="panel-title"><i class="icon-book"></i> Laporan</h9>
  </div>
  <form action="<?php echo site_url('Laporan/eks'); ?>" method="post">
    <div class="panel-body">
      <div class="row">
        <div class="form-group">
          <label class='col-md-2'>Agama</label>
          <div class='col-md-9'>
            <select data-placeholder="Pilih Agama" name="agama" class="select-clear">
              <?php $agama=$this->db->get('agama')->result(); ?>
              <option value=""></option>
              <?php 
                 $no=0; foreach($agama as $r): $no++;
                 echo '<option value="'.$r->id_agama.'">'.$r->agama.'</option>';
                 endforeach;
              ?>
            </select>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="form-group">
          <label class='col-md-2'>Jenis Kelamin</label>
          <div class='col-md-9'>
            <select data-placeholder="Pilih Jenis Kelamin" name="jk" class="select-clear">
              <option value=""></option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="form-group">
          <label class='col-md-2'>Status</label>
          <div class='col-md-9'>
            <select data-placeholder="Pilih Status" name="status" class="select-clear">
              <option value=""></option>
              <option value="1">Hidup</option>
              <option value="2">Meninggal</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <br>
      <center><button type="submit" class="btn btn-md btn-primary"><i class="icon-download"></i> Ekspor Ke Excel</button></center>
      <br>
    </div>
  </form>
</div>