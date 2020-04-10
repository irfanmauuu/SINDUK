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
    <h5 class="panel-title"><i class="icon-pencil7"></i> Edit Data No KK <b><i><?=getnamakk($id);?></i></b></h5>
  </div>
  <?php echo form_open('Entry/editkkprocess'); ?>
  <input type="hidden" value="<?php echo $id; ?>" name="id">
  <div class="panel-body">
    <div class="form-group">
      <label class='col-md-3'>No KK</label>
      <div class='col-md-9'><input type="text" name="no_kk" value="<?php echo $getrow['no_kk'] ;?>" autocomplete="off" required placeholder="Masukkan No KK" class="form-control" ></div>
    </div>
    <br>
    <br>
    <div class="form-group">
      <label class='col-md-3'>RT</label>
      <div class='col-md-9'><input type="text" name="rt" value="<?php echo $getrow['rt'] ;?>" autocomplete="off" required placeholder="Masukkan RT" class="form-control" ></div>
    </div>
    <br>
    <br>
    <div class="form-group">
      <label class='col-md-3'>RW</label>
      <div class='col-md-9'><input type="text" name="rw" value="<?php echo $getrow['rw'] ;?>" autocomplete="off" required placeholder="Masukkan RW" class="form-control" ></div>
    </div>
    <br>
    <br>
  </div>
   <div class="panel-footer">
   <br>
      <div class="row">
        <center><button type="submit" class="btn btn-warning"><i class="icon-pencil5"></i> Edit</button></center>
      </div>
    <br>
   </div>
   <?php echo form_close(); ?>
</div>