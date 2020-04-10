<a href="<?php echo site_url('Entry/addindividu/'.$id); ?>" class="btn btn-primary btn-sm"><i class="icon-file-plus"></i> Tambah </a>
<?php 
echo br(2);
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
    <h5 class="panel-title"><i class="icon-pencil7"></i> Detail Individu Di KK <b><i><?=getnamakk($id);?></i></b></h5>
  </div>
  <div class="panel-body">
    <table class="table table-bordered datatable-columns">
      <thead>
          <tr>
              <th>No</th>
              <th>Ket</th>
              <th>NIK</th>
              <th class="never"></th>
              <th>Nama</th>
              <th>JK</th>
              <th>Tanggal Lahir</th>
              <th>Status</th>
              <th><center>Opsi</center></th>
          </tr>
      </thead>
      <tbody>
          <?php $no=0; foreach($all as $row): $no++; ?>
            <tr>
                <td></td>
                <td>
                  <center>
                    <?php $num=cekKK($row->nik); 
                      if($num>0){
                        echo '<a href="#" class="btn btn-primary btn-xs tooltips" data-popup="tooltip" data-original-title="Kepala Keluarga" data-placement="top"><i class="icon-home7"></i></a>';
                      }else{
                        echo '<a href="'.site_url('entry/kk/'.$row->nik).'" class="btn btn-default btn-xs tooltips" data-popup="tooltip" data-original-title="Jadikan Kepala Keluarga" data-placement="top"><i class="icon-quill4"></i></a>';
                      }
                    ?>
                  </center>
                </td>
                <td><?php echo $row->nik; ?></td>
                <td><?php echo $no; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jk; ?></td>
                <td><?php echo $row->tanggal_lahir; ?></td>
                <td>
                <?php if($row->status==1){
                  echo "<span class='label label-success'> Hidup</span>";
                  $site=site_url('entry/deadindividu/'.$row->nik);
                  $teks="Nonaktifkan Data";
                  $icon="switch";
                  $class="warning";
                }elseif($row->status==2){
                  echo "<span class='label label-danger'> Meninggal</span>";
                  $site=site_url('entry/onindividu/'.$row->nik);
                  $teks="Aktifkan Data";
                  $icon="switch";
                  $class="default";
                }else{
                  echo "<label class='label label-primary> Lainnya</label>";
                  $site=site_url('entry/onindividu/'.$row->nik);
                  $teks="Aktifkan Data";
                  $icon="switch";
                  $class="default";
                }?>
                </td>
                <td>
                  <center>
                    <a href="<?php echo site_url('entry/detailindividu/'.$row->nik); ?>" class="btn btn-success btn-xs tooltips" data-popup="tooltip" data-original-title="Detail Data" data-placement="top"><i class="icon-zoomin3"></i></a>
                    <a href="<?php echo site_url('entry/editindividu/'.$row->nik); ?>" class="btn btn-info btn-xs tooltips" data-popup="tooltip" data-original-title="Edit Data" data-placement="top"><i class="icon-pencil5"></i></a>
                    <a href="<?php echo $site; ?>" onclick="return confirm('Anda Yakin Merubah Status Data Ini');" class="btn btn-<?=$class;?> btn-xs tooltips" data-popup="tooltip" data-original-title="<?php echo $teks; ?>" data-placement="top"><i class="icon-<?=$icon;?>"></i></a>
                    <a href="<?php echo site_url('entry/hapusindividu/'.$row->nik); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini');" class="btn btn-danger btn-xs tooltips" data-popup="tooltip" data-original-title="Hapus Data" data-placement="top"><i class="icon-x"></i></a>
                  </center>
                </td>
            </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>