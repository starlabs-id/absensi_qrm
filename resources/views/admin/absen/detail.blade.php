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
                    Daftar Absen <small>{{ $absen->name }}</small>

                    <span class="pull-right">
                        <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                        <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                        <form method="post" id="frm-nota" action="{{ route('absen.create') }}" enctype="multipart/form-data" class="pull-right">
                            {{ csrf_field() }}
                            <input type="text" hidden class="form-control" name="tukang_id" value="{{ $tukangs['id'] }}">
                            <button type="submit" class="btn btn-sm btn-danger">Absen</button>
                        </form>
                        <button onclick="goBack()" style="margin-right: 5px;" class="btn btn-warning btn-sm pull-right">
                            Kembali
                        </button>
                    </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($absens as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->hari_datang }}, {{ $row->tanggal_datang }}</td>
                                <td>{{ $row->jam_datang }}</td>
                                <td>{{ $row->jam_pulang }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>
                                    <form method="post" action="{{ route('absen.create') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" hidden class="form-control" name="tukang_id" value="{{ $tukangs['id'] }}">
                                        <button type="submit" class="btn btn-xs btn-danger">Absen Pulang</button>
                                    </form>
                                    <a href="#modal-validasi" data-toggle="modal" class="btn btn-success btn-sm btn-edit"
                                        data-id="">Validasi
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                

                {{-- Modal Validasi --}}
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Validasi Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="idx" class="form-control" placeholder="ID" required>
                                        <input type="hidden" readonly class="form-control" id="validasi_by" name="validasi_by" value="{{ Auth::user()->id }}">
                                        <input type="text" readonly class="form-control" id="projek_id" name="projek_id" value="">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Status</label>
                                        <select class="form-control">
                                            <option>Hadir</option>
                                            <option>Sakit</option>
                                            <option>Alpa</option>
                                            <option>Ijin</option>
                                            <option>Lembur</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>
@endsection