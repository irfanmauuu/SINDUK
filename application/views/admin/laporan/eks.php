<?php 
header("content-type:Application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=OutputPenduduk.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style>
td {
   vertical-align: middle;
}
</style>
<table border="1" style="font-size:13px;border:100px;font-family:Arial;">
    <thead>
      <tr>
          <th>No</th>
          <th width='150'>NIK</th>
          <th width='150'>No KK</th>
          <th width='200'>Nama</th>
          <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>JK</th>
          <th>Golongan<br>Darah</th>
          <th >Alamat</th>
          <th >Pekerjaan</th>
          <th>Agama</th>
          <th>Kewarganegaraan</th>
          <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0; foreach($all as $row): $no++;?>
      <tr>
        <td><center>&nbsp;<?php echo $no; ?></center></td>
        <td>&nbsp;<?php echo $row->nik; ?></td>
        <td width="80">&nbsp;<?php echo getnamakk($row->id_kk); ?></td>
        <td>&nbsp;<?php echo $row->nama; ?></td>
        <td>&nbsp;<?php echo $row->tempat_lahir; ?></td>
        <td>&nbsp;<?php echo $row->tanggal_lahir; ?></td>
        <td width="100">&nbsp;<?php echo $row->jk; ?></td>
        <td>&nbsp;<?php echo $row->golongan_darah; ?></td>
        <td>&nbsp;<?php echo $row->alamat; ?></td>
        <td>&nbsp;<?php echo $row->pekerjaan; ?></td>
        <td>&nbsp;<?php echo $row->agama; ?></td>
        <td>&nbsp;<?php echo $row->kewarganegaraan; ?></td>
        <td>&nbsp;<?php if($row->status==1){echo 'Hidup';}else{'Meninggal';} ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>