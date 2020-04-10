<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/visualization/echarts/echarts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/charts/echarts/bars_tornados.js') ?>"></script>
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
<div class="panel panel-flat">
  <div class="panel-body">
    <div class="chart-container">
    <div class="col-md-6">
	  <center><i class="label label-info"><strong>Berdasarkan Jenis Kelamin</strong></i></center>
	  <hr>
      <center><div class="chart has-fixed-height" id="basic_bars"></div></center>
    </div>
    <div class="col-md-6">
	    <center><i class="label label-default"><strong>Berdasarkan Status</strong></i></center>
	    <hr>
      	<center><div class="chart has-fixed-height" id="basic_line"></div></center>
    </div>
    <br><br><br>
    <div class="col-md-12">
	  <center><i class="label label-primary"><strong>Berdasarkan Agama</strong></i></center>
	  <hr>
      <center><div class="chart has-fixed-height" id="basic_columns"></div></center>
    </div>
    </div>
  </div>
</div>
<?php $agama=$this->db->get('agama')->result(); ?>
<script>
$(function () {
	require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
        }
    });
    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],
        function (ec, limitless) {
            var basic_bars = ec.init(document.getElementById('basic_bars'), limitless);
            var basic_line = ec.init(document.getElementById('basic_line'), limitless);
        	var basic_columns = ec.init(document.getElementById('basic_columns'), limitless);
            basic_bars_options = {
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    data: ['Laki-Laki', 'Perempuan']
                },
                calculable: true,
                xAxis: [{
                    type: 'value',
                    boundaryGap: [0, 1]
                }],
                yAxis: [{
                    type: 'category',
                    data: ['']
                }],
                series: [
                    {
                        name: 'Laki-Laki',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#EF5350'
                            }
                        },
                        data: [<?php echo $this->db->query("select nik from penduduk where jk='Laki-laki'")->num_rows(); ?>]
                    },
                    {
                        name: 'Perempuan',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#66BB6A'
                            }
                        },
                        data: [<?php echo $this->db->query("select nik from penduduk where jk='Perempuan'")->num_rows(); ?>]
                    }
                ]
            };
            basic_line_options = {
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    data: ['Meninggal', 'Hidup']
                },
                calculable: true,
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 1]
                }],
                xAxis: [{
                    type: 'category',
                    data: ['']
                }],
                series: [
                    {
                        name: 'Meninggal',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#EF5350'
                            }
                        },
                        data: [<?php echo getjumstatus(2); ?>]
                    },
                    {
                        name: 'Hidup',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#66BB6A'
                            }
                        },
                        data: [<?php echo getjumstatus(1); ?>]
                    }
                ]
            };
            basic_columns_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Jumlah']
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: [<?php $no=0; foreach($agama as $row): $no++;?>'<?php echo $row->agama; ?>',<?php endforeach;?>]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Jumlah',
                        type: 'line',
                        data: [<?php $no=0; foreach($agama as $row): $no++;?>'<?php echo getjumagama($row->id_agama); ?>',<?php endforeach;?>],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                    },
                    
                ]
            };



            // Apply options
            // ------------------------------

            basic_columns.setOption(basic_columns_options);
            basic_bars.setOption(basic_bars_options);
            basic_line.setOption(basic_line_options);
            window.onresize = function () {
                setTimeout(function (){
                	basic_columns.resize();
                    basic_bars.resize();
                    basic_line.resize();
                }, 200);
            }
        }
    );
});
</script>