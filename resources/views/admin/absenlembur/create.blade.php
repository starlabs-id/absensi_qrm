@extends('layouts.master')

@section('content')
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script> -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
        width: 100% !important;
        height: auto;
    }
</style>

<!-- <style type="text/css">
    .canvas{
        background: #fff;border: 1px solid #000
    }
	.wrapperx{
		background: #fff;width: 280px;padding: 10px;
    }
</style> -->

<!--CSS LeafletJS-->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/> -->
<!--JavaScript LeafletJS-->
<!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script> -->


<?php
    function hari_ini(){
        $hari = date ("D");
    
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak diketahui";		
            break;
        }
    
        return $hari_ini;
    }

    $hariIni = \Carbon\Carbon::now()->locale('id');
?>


<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Absen</small>
                <span class="pull-right">
                    <button onclick="goBack()" style="margin-right: 5px;" class="btn btn-warning btn-sm pull-right">
                        Kembali
                    </button>
                </span>
            </div>
            <button onclick="getLocation()" class="btn btn-success">Tentukan Lokasi</button>
            <br><br>

            <form action="{{ route('absenlembur.add') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jam_datang">Jam Datang</label>
                            <input type="text" hidden class="form-control" id="projek_id" name="projek_id" value="{{ $tukangs->projek_id }}">
                            <input type="text" hidden class="form-control" id="tukang_id" name="tukang_id" value="{{ $tukangs->id }}">
                            <input type="text" hidden class="form-control" id="user_id" name="user_id" value="{{ $tukangs->user_id }}">
                            <input type="text" readonly class="form-control" id="jam_datang" name="jam_datang" value="{{ date('H:i:s') }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_datang">Tanggal Datang</label>
                            <input type="text" readonly class="form-control" id="tanggal_datang" name="tanggal_datang" value="{{ date('d-m-Y') }}">
                        </div>
                        <div class="form-group">
                            <label for="hari_datang">Hari</label>
                            <input type="text" readonly class="form-control" id="hari_datang" name="hari_datang" value="{{ hari_ini() }}">
                        </div>
                        <div class="form-group">
                            <label for="bulan_datang">Bulan</label>
                            <input type="text" readonly class="form-control" id="bulan_datang" name="bulan_datang" value="{{ $hariIni->monthName }}">
                        </div>
                        <div class="form-group">
                            <label for="tahun_datang">Tahun</label>
                            <input type="text" readonly class="form-control" id="tahun_datang" name="tahun_datang" value="{{ date('Y') }}">
                        </div>
                        <div class="form-group">
                            <label for="lokasi_datang">Lokasi Datang</label>
                            <textarea type="text" readonly class="form-control" id="lokasi_datang" name="lokasi_datang" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <div class="form-group">
                            <label for="ttd">Tanda Tangan</label>
                            <!-- <br>
                            <canvas class="canvas" name="ttd"></canvas>
                            <div class="wrapperx"> -->
                            <br/>
                            <div id="sig"></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-xs">Hapus</button>
                            <textarea id="signature64" name="ttd" style="display: none" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/png, image/jpg, image/jpeg" required>
                        </div>

                        @can('absen-add')
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script type="text/javascript">
	var canvas = document.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas);
</script> -->
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

<script type="text/javascript">
    var latitude = document.getElementById("lokasi_datang");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            latitude.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        latitude.innerHTML = position.coords.latitude+','+position.coords.longitude;
    }
</script>
@endsection