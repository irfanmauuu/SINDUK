<div class="sidebar sidebar-main sidebar-fixed">
  <div class="sidebar-content">
    <div class="sidebar-user">
    </div>
    <div class="sidebar-category sidebar-category-visible">
      <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
          <li class="<?php echo menuaktif('dashboard',$aktif); ?>"><a href="<?php echo base_url(); ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
          <li>
            <a href="#"><i class="icon-people"></i> <span>Penduduk</span></a>
            <ul>
              <li class="<?php echo menuaktif('entry',$aktif); ?>"><a href="<?php echo site_url('Entry'); ?>"><i class="icon-pencil7"></i> <span>Data Penduduk</span></a></li>
              <li class="<?php echo menuaktif('laporan',$aktif); ?>"><a href="<?php echo site_url('Laporan'); ?>"><i class="icon-book"></i> <span>Laporan</span></a></li>
              <li class="<?php echo menuaktif('all',$aktif); ?>"><a href="<?php echo site_url('Entry/all'); ?>"><i class="icon-file-eye2"></i> <span>Searching</span></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>