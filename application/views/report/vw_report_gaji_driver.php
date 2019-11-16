<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Laporan Gaji Driver</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#"> Report</a></li>
          <li class="active"><a href="#"> Gaji Driver</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="box box-default">
                <div class="box-header">
                    <form id="form-filter">
                        <div class="row">
                            <div class="col-md-3">
                                <input id="tgl_awal" class="form-control tanggal" placeholder="Tanggal Awal" type="text">
                            </div>
                            <div class="col-md-3">
                                <input id="tgl_akhir" placeholder="Tanggal Akhir" class="form-control tanggal" type="text">    
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="LastName" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" id="btn-filter" onclick="report()" class="btn btn-info">Tampilkan</button>
                                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                    <br><br>   
                </div>
                <div id="tabel-div" hidden class="box-body table-responsive">
                    <h2 id="judul"></h2>
                    <table id="tabel" class="table table-bordered table-striped table-hover js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid" >
                        <thead>
                        <tr>
                            <th><center>No</th>
                            <th><center>Nama Driver</th>
                            <th><center>Januari</th>
                            <th><center>Februari</th>
                            <th><center>Maret</th>
                            <th><center>April</th>
                            <th><center>Mei</th>
                            <th><center>Juni</th>
                            <th><center>Juli</th>
                            <th><center>Agustus</th>
                            <th><center>September</th>
                            <th><center>Oktober</th>
                            <th><center>November</th>
                            <th><center>Desember</th>
                            <th><center>Total</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>

<script type="text/javascript">
    function report(){
        var tgl_awal = $('#tgl_awal').val();
        var tgl_akhir = $('#tgl_akhir').val();
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        var date_awal   = new Date(tgl_awal);
        var day_awal    = date_awal.getDate();
        var month_awal  = months[date_awal.getMonth()];
        var year_awal   = date_awal.getFullYear();
        var new_tgl_awal = day_awal + ' ' + month_awal + ' ' + year_awal;

        var date_akhir  = new Date(tgl_akhir);
        var day_akhir   = date_akhir.getDate();
        var month_akhir = months[date_akhir.getMonth()];
        var year_akhir  = date_akhir.getFullYear();
        var new_tgl_akhir = day_akhir + ' ' + month_akhir + ' ' + year_akhir;

        $('#tabel-div').prop('hidden',true);
        $('#tabel').DataTable().clear().destroy();
        $('#tabel').DataTable({
            processing  : true, //Feature control the processing indicator.
            serverSide  : true, //Feature control DataTables' server-side processing mode.
            order       : [], //Initial no order.
            autowidth   : true,
            ordering    : false,

            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('doring/report_gaji')?>" ,
                "type": "POST",
                "data": function ( data ) {
                    data.tgl_awal = tgl_awal;
                    data.tgl_akhir = tgl_akhir;
                }
            },
            "initComplete":function( settings, json){
                //console.log(json);
                // call your function here
                $('#judul').text('Periode ' + new_tgl_awal + ' s/d ' + new_tgl_akhir)
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    title: 'Laporan Gaji Driver Periode ' + new_tgl_awal + ' s/d ' + new_tgl_akhir
                },{
                extend: 'excel',
                title: 'Laporan Gaji Driver Periode ' + new_tgl_awal + ' s/d ' + new_tgl_akhir
            },
            {
                extend: 'print',
                title: 'Laporan Gaji Driver Periode ' + new_tgl_awal + ' s/d ' + new_tgl_akhir
            }
            ]
        });

        $('#tabel-div').prop('hidden',false);
    }

    $('.tanggal').datepicker({
        autoclose: true,
        format:"yyyy-mm-dd",
    });
</script>