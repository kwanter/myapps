<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
table.dataTable thead {
  border-bottom: 5px solid black !important;
}
</style>
<section class="content-wrapper">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Data Dokumen Kapal</h1>
            <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Dokumen Kapal</a></li>
            <li class="active"><a href="#"> Dokumen Kapal</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-default">
                <div class="box-header">
                    <button class="btn btn-primary" onclick="add()"> <span>Tambah Data</span></button><br><br>   
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Custom Filter : </h3>
                    </div>
                    <div class="panel-body">
                        <form id="form-filter">
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="agent" class="form-control" placeholder="Agen" type="text">
                                </div>
                                <div class="col-md-2">
                                    <input id="shipper" placeholder="Pengirim" class="form-control" type="text">    
                                </div>
                                <div class="col-md-2">
                                    <input id="receiver" placeholder="Penerima" class="form-control" type="text">
                                </div>
                                <div class="col-md-2">
                                    <input id="product" placeholder="Produk" class="form-control" type="text">  
                                </div>
                                <div class="col-md-2">
                                    <input id="company" placeholder="Perusahaan" class="form-control" type="text">          
                                </div>
                                <br><br><br>
                                <div class="col-md-3">
                                    <input id="nama_kapal" placeholder="Nama Kapal" class="form-control" type="text">          
                                </div>
                                <div class="col-md-3">
                                    <input id="tgl_kapal_awal" placeholder="Tgl Kapal Tiba (Awal)" class="form-control tanggal" type="text">
                                </div>
                                <div class="col-md-3">
                                    <input id="tgl_kapal_akhir" placeholder="Tgl Kapal Tiba (Akhir)" class="form-control tanggal" type="text">    
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="LastName" class="col-sm-2 control-label"></label>
                                <div class="col-sm-4">
                                    <button type="button" id="btn-filter" class="btn btn-warning">Filter</button>
                                    <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="tabel" class="table table-bordered table-striped table-hover js-basic-example dataTable nowrap cell-border" cellspacing="0" role="grid" >
                        <thead>
                        <tr>
                            <th><center>No</th>
                            <th><center>No Petikemas</th>
                            <th><center>Nama Kapal</th>
                            <th><center>Tanggal Berita Acara</th>
                            <th><center>Tanggal Dokumen</th>
                            <th><center>Tanggal Kapal Tiba</th>
                            <th><center>Perusahaan</th>
                            <th><center>Agen</th>
                            <th><center>Origin</th>
                            <th><center>Pengirim</th>
                            <th><center>Penerima</th>
                            <th><center>No Berita Acara</th>
                            <th><center>No Surat Jalan</th>
                            <th><center>Produk</th>
                            <th><center>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th><center>No</th>
                            <th><center>No Petikemas</th>
                            <th><center>Nama Kapal</th>
                            <th><center>Tanggal Berita Acara</th>
                            <th><center>Tanggal Dokumen</th>
                            <th><center>Tanggal Kapal Tiba</th>
                            <th><center>Perusahaan</th>
                            <th><center>Agen</th>
                            <th><center>Origin</th>
                            <th><center>Pengirim</th>
                            <th><center>Penerima</th>
                            <th><center>No Berita Acara</th>
                            <th><center>No Surat Jalan</th>
                            <th><center>Produk</th>
                            <th><center>Aksi</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
      </section>
    </div>
</section>

<script type="text/javascript">
    var table;

    function reload_table() {
        table.ajax.reload(null,false);
    }

    function add() {
        window.location.replace('<?php echo site_url('shipment/')?>');
    }

    function edit(id) {
        window.location.replace('<?php echo site_url('shipment/edit/')?>'+id);
    }

    $(document).ready(function(){
        table = $('#tabel').DataTable({
            processing  : true, //Feature control the processing indicator.
            serverSide  : true, //Feature control DataTables' server-side processing mode.
            order       : [], //Initial no order.
            autowidth   : true,
            ordering    : false,
            scrollY     : 300,
            scrollX     : true,
            scrollCollapse: true,
            fixedColumns:   {
                leftColumns: 2,
                heightMatch: 'auto'
            },

            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('shipment/ajax_list')?>" ,
                "type": "POST",
                "data": function ( data ) {
                    data.company        = $('#company').val();
                    data.shipper        = $('#shipper').val();
                    data.receiver       = $('#receiver').val();
                    data.product        = $('#product').val();
                    data.agent          = $('#agent').val();
                    data.nama_kapal        = $('#nama_kapal').val();
                    data.tgl_kapal_awal    = $('#tgl_kapal_awal').val();
                    data.tgl_kapal_akhir   = $('#tgl_kapal_akhir').val();
                }
            },
        });
        $('#container').css( 'display', 'block' );
        table.columns.adjust().draw();

        $('#agent').keyup( function() {
            //table.draw();
            table.ajax.reload();
        } );
        $('#shipper').keyup( function() {
            table.ajax.reload();
        } );
        $('#receiver').keyup( function() {
            table.ajax.reload();
        } );
        $('#product').keyup( function() {
            table.ajax.reload();
        } );
        $('#company').keyup( function() {
            table.ajax.reload();
        } );
        $('#nama_kapal').keyup( function() {
            table.ajax.reload();
        } );
        $('#btn-filter').click(function(){ //button filter event click
            table.ajax.reload();  //just reload table
        });
        $('#btn-reset').click(function(){ //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload();  //just reload table
        });
    });

    function del(id) {
        swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: 'Anda Tidak Akan Bisa Merecover Kembali Data Yang Sudah Anda Hapus !',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url : "<?php echo site_url('shipment/delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        swal.fire('Terhapus','Data Anda Sudah Dihapus','success');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal.fire("Gagal","Data Anda Tidak Jadi Dihapus","error");
                    }
                });
            } else {
                swal.fire("Batal","Data Anda Tidak Jadi Dihapus","warning");
            }
        });
    }

    $('.tanggal').datepicker({
            autoclose: true,
            format:"yyyy-mm-dd",
    });
</script>