<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?>||SINDUK</title>
  <link href="<?php echo base_url('assets/css/css.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/minified/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/minified/core.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/minified/components.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/minified/colors.min.css'); ?>" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/pace.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/jquery.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/core/libraries/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/loaders/blockui.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/pages/components_modals.js');?>"></script>
  <!-- /core JS files -->
<script type="text/javascript" src="<?php echo base_url('assets/js/core/app.js'); ?>"></script>
<style>
   .img4{
     width:50px;
     height:60px;
    transition: all 0.5s;
    -o-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    }
    .img4:hover {
      transition: all 2s;
      -o-transition: all 2s;
      -moz-transition: all 2s;
      -webkit-transition: all 2s;
      transform: scale(3);
      -moz-transform: scale(3);
      -o-transform: scale(3);
      -webkit-transform: scale(3);
      box-shadow: 2px 2px 6px rgba(0,0,0,2);
    }
</style>
</head>

<body class="navbar-top">
  <?php include "head.php"; ?>
  <div class="page-container">
    <div class="page-content">
      <?php include $menu; ?>
      <div class="content-wrapper">
        <div class="page-header">
          <div class="breadcrumb-line">
            <?php echo $this->breadcrumb->output(); ?>
          </div>
        </div>
        <br>
        <div class="content">
          <?php include $content; ?>
        </div>
        <div class="row">
          <div id="ganti" class="modal fade">
              <div class="modal-dialog">
                <form action="<?php echo site_url('Welcome/update'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><strong>Ubah Username Password</strong></h6>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label class='col-md-3'>Username</label>
                      <div class='col-md-9'><input type="text" name="username" placeholder="Masukkan Username" class="form-control" ></div>
                    </div>
                    <br>
                    <?php 
                    $pend=$this->session->userdata('id_penduduk');
                    $qu=$this->db->query("select * from admin where id_penduduk='$pend'")->row_array(); ?>
                    <input type="hidden" name="passlama" value="<?php echo $qu['password']; ?>">
                    <input type="hidden" name="userlama" value="<?php echo $qu['username']; ?>">
                    <div class="form-group">
                      <label class='col-md-3'>Password Lama</label>
                      <div class='col-md-9'><input type="password" name="password" autocomplete="off" required placeholder="Masukkan Password" class="form-control" ></div>
                    </div>
                    <br>
                    <div class="form-group">
                      <label class='col-md-3'>Password Baru</label>
                      <div class='col-md-9'><input type="password" name="password_baru" autocomplete="off" required placeholder="Masukkan Password Baru" class="form-control" ></div>
                    </div>
                    <br>
                    <div class="form-group">
                      <label class='col-md-3'>Konfirmasi Password Baru</label>
                      <div class='col-md-9'><input type="password" name="konf_baru" autocomplete="off" required placeholder="Masukkan Konfirmasi Password Baru" class="form-control" ></div>
                    </div>
                    <br>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
                    </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>