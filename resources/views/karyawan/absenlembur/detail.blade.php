@extends('layouts.master')

@section('content')
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

<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Daftar Absen Lembur <small>{{ $absen->name }}</small>

                    <span class="pull-right">
                        <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                        <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                        @can('absen-add')
                            <a href="{{ route('absensilembur.create', $tukangs->id) }}" class="btn btn-danger btn-sm">Absen Lembur</a>
                        @endcan
                        <button class="btn btn-warning btn-sm"><a href="{{ route('absensilembur.index') }}">Kembali</a></button>
                    </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>TTD</th>
                                <th>Tanggal</th>
                                <th>Jam Datang</th>
                                <th>Lokasi Datang</th>
                                <th>Jam Pulang</th>
                                <th>Lokasi Pulang</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Total Lembur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($absens as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if($row->foto != '')
                                        <img src="{{ asset('storage/absenlembur/' . $row->foto) }}" style="width:30%">
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($row->ttd != '')
                                        <img src="{{ asset('ttd_lembur/' . $row->ttd) }}" style="width:40%">
                                    @else
                                    @endif
                                </td>
                                <td>{{ $row->hari_datang }}, {{ $row->tanggal_datang }}</td>
                                <td>{{ $row->jam_datang }}</td>
                                <td>{{ $row->lokasi_datang }}</td>
                                <td>{{ $row->jam_pulang }}</td>
                                <td>{{ $row->lokasi_pulang }}</td>
                                <td>
                                    @if($row->status == 'Hadir')
                                        <span class="badge badge-success m-2">Hadir</span>
                                    @elseif($row->status == 'Sakit')
                                        <span class="badge badge-warning m-2">Sakit</span>
                                    @elseif($row->status == 'Tidak Hadir')
                                        <span class="badge badge-danger m-2">Tidak Hadir</span>
                                    @elseif($row->status == 'Lembur')
                                        <span class="badge badge-danger m-2">Lembur</span>
                                    @else
                                    @endif
                                </td>
                                <td>{{ $row->keterangan }}</td>
                                <td>Rp. {{ number_format($row->total_biaya_lembur, 2, ',', '.') }}</td>
                                <td>
                                    @can('karyawan-absenlembur-update')
                                        @if($row->tanggal_datang == date('d-m-Y'))
                                            <form method="post" action="{{ route('absensilembur.update') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="text" hidden class="form-control" name="id" value="{{ $row['id'] }}">
                                                <input type="text" hidden class="form-control" name="tukang_id" value="{{ $row['tukang_id'] }}">
                                                <input type="text" hidden class="form-control" name="user_id" value="{{ $row['user_id'] }}">
                                                <input type="text" hidden class="form-control" id="tanggal_pulang" name="tanggal_pulang" value="{{ date('d-m-Y') }}">
                                                <input type="text" hidden class="form-control" id="hari_pulang" name="hari_pulang" value="{{ hari_ini() }}">
                                                <input type="text" hidden class="form-control" id="bulan_pulang" name="bulan_pulang" value="{{ $hariIni->monthName }}">
                                                <input type="text" hidden class="form-control" id="tahun_pulang" name="tahun_pulang" value="{{ date('Y') }}">
                                                <input type="text" hidden class="form-control" id="jam_pulang" name="jam_pulang" value="{{ date('H:i:s') }}">
                                                <input type="text" hidden class="form-control" name="latitude_pulang" id="latitude" required>
                                                <input type="text" hidden class="form-control" name="longitude_pulang" id="longitude" required>
                                                @if($row->jam_pulang == '')
                                                    <button type="submit" class="btn btn-xs btn-primary pull-right" style="margin-left:5px;">Absen Pulang</button>
                                                @else
                                                @endif
                                            </form>
                                        @else
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>
@endsection

@section('customJs')
<script>
    // var long=document.getElementsByClassName("long");
    function getLocation()
    {
        if(navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else{
            long.innerHTML="Geolocation is not supported by this browser.";
            }
        }
    function showPosition(position)
    {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
    }
    getLocation()
</script>
@endsection