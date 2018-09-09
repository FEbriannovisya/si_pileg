<?php
    require_once "../include/class.function.php";

    $dbo = new MyFunction();
    $provinsi = $dbo->getDataProvinsi(); // 1 -> DPRD Kabupaten
?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Edit Data Relawan</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="javascript:void(0);">DPRD Kabupaten</a></li>
            <li><a href="?page=data_relawan_kab">Data Relawan</a></li>
            <li class="active">Edit Data Baru</li>
        </li>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="?page=data_relawan_kab">
                    <button type="button" class="btn btn-outline btn-primary"><i class="fa fa-reply"></i>&nbsp;Lihat Data Relawan</button>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>ID Relawan</label>
                                <input class="form-control" placeholder="ID Relawan">
                                <p class="help-block">Nomor <strong>ID Relawan</strong> akan terisi secara otomatis.</p>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input class="form-control" placeholder="NIK">
                                <p class="help-block">Pastikan <strong>NIK</strong> yang digunakan adalah benar.</p>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control">
                                    <option value="">-- Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>No. Telp/HP</label>
                                <input class="form-control" placeholder="No. Telp/HP">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" id="provinsi">
                                    <option selected="selected" value="">-- Provinsi --</option>
                                <?php 
                                    foreach ($provinsi as $data) {
                                        echo '<option value="'.$data["id_prov"].'">'.$data["nama_prov"].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select class="form-control" id="kabupaten"></select>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" id="kecamatan"></select>
                            </div>
                            <div class="form-group">
                                <label>Kelurahan/Desa</label>
                                <select class="form-control" id="kelurahan"></select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-outline btn-success"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                            <button type="reset" class="btn btn-outline btn-danger"><i class="fa fa-times"></i>&nbsp; Batalkan</button>
                        </div>
                    </form>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<script type="text/javascript"> 
    $(document).ready(function() {
        $("#kabupaten").append('<option selected="selected" value="">-- Kabupaten/Kota --</option>');
        $("#kecamatan").append('<option selected="selected" value="">-- Kecamatan --</option>'); 
        $("#kelurahan").append('<option selected="selected" value="">-- Kelurahan/Desa --</option>');
    });

    $("#provinsi").change(function() { 
        $("#kabupaten").html('');
        $("#kabupaten").append('<option selected="selected" value="">-- Kabupaten/Kota --</option>');

        var id_prov = $("#provinsi").val(); 
        var api_url = '../api/api.php?method=get_data_kabupaten';

        $.ajax(
        {
            url: api_url, 
            type: 'GET', 
            dataType: 'json',
            data: "id_prov=" + id_prov,
            cache: false,
            success: function(result) {
                // var jsonStr = $.parseJSON(JSON.stringify(result));
                // alert(jsonStr);
                // alert(result.kabkota[0].nama_kab);
                // alert(result.kabkota.length);

                if (result.status == true) {
                    // alert("Got it!");
                    for (var i = 0; i < result.kabkota.length; i++) {
                        $("#kabupaten").append('<option value="'+ result.kabkota[i].id_kab +'">' + result.kabkota[i].nama_kab + '</option>');
                    }
                } else {
                    alert(result.message);
                }
            }
        });  
    });

    $("#kabupaten").change(function() {
        $("#kecamatan").html('');
        $("#kelurahan").html('');
        $("#kecamatan").append('<option value="">-- Kecamatan --</option>'); 
        $("#kelurahan").append('<option value="">-- Kelurahan/Desa --</option>');

        var id_kab = $("#kabupaten").val(); 
        var api_url = '../api/api.php?method=get_data_kecamatan';

        $.ajax(
        {
            url: api_url, 
            type: 'GET', 
            dataType: 'json',
            data: "id_kab=" + id_kab,
            cache: false,
            success: function(result) {
                if (result.status == true) {
                    // alert("Got it!");
                    for (var i = 0; i < result.kecamatan.length; i++) {
                        $("#kecamatan").append('<option value="'+ result.kecamatan[i].id_kec +'">' + result.kecamatan[i].nama_kec + '</option>');
                    }
                } else {
                    alert(result.message);
                }
            } 
        });
    });

    $("#kecamatan").change(function() {
        $("#kelurahan").html('');
        $("#kelurahan").append('<option value="">-- Kelurahan/Desa --</option>');

        var id_kec = $("#kecamatan").val(); 
        var api_url = '../api/api.php?method=get_data_kelurahan';
        
        $.ajax(
        {
            url: api_url,
            type: 'GET',
            dataType: 'json',
            data: "id_kec=" + id_kec,
            cache: false,
            success : function(result) {
                if (result.status == true) {
                    // alert("Got it!");
                    for (var i = 0; i < result.desa.length; i++) {
                        $("#kelurahan").append('<option value="'+ result.desa[i].id_kel +'">' + result.desa[i].nama_kel + '</option>');
                    }
                } else {
                    alert(result.message);
                }
            }
        });
    });
</script>