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
                            <a href="{{ route('absenlembur.create', $tukangs->id) }}" class="btn btn-danger btn-sm">Absen Lembur</a>
                        @endcan
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
                                <th>Foto</th>
                                <th>TTD</th>
                                <th>Tanggal</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
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
                                <td>{{ $row->jam_pulang }}</td>
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
                                    @can('absen-destroy')
                                    <a href="#!" class="btn btn-danger btn-xs btn-hapus pull-right" style="margin-left:5px;" data-id="{{ $row->id }}">Hapus</a>
                                    @endcan
                                    @can('validasi')
                                        @if($row->validasi_by == '')
                                            <a href="#modal-edit" data-toggle="modal" class="btn btn-success btn-xs btn-edit pull-right" style="margin-left:5px;"
                                                data-id="{{ $row->id }}"
                                                data-projek_id="{{ $row->projek_id }}"
                                                data-tukang_id="{{ $row->tukang_id }}"
                                                data-user_id="{{ $row->user_id }}">Validasi
                                            </a>
                                        @else
                                    @endcan
                                    @endif
                                    @if($row->tanggal_datang == date('d-m-Y'))
                                        <form method="post" action="{{ route('absenlembur.update') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="text" hidden class="form-control" name="id" value="{{ $row['id'] }}">
                                            <input type="text" hidden class="form-control" name="tukang_id" value="{{ $row['tukang_id'] }}">
                                            <input type="text" hidden class="form-control" name="user_id" value="{{ $row['user_id'] }}">
                                            <input type="text" hidden class="form-control" id="tanggal_pulang" name="tanggal_pulang" value="{{ date('d-m-Y') }}">
                                            <input type="text" hidden class="form-control" id="hari_pulang" name="hari_pulang" value="{{ hari_ini() }}">
                                            <input type="text" hidden class="form-control" id="bulan_pulang" name="bulan_pulang" value="{{ $hariIni->monthName }}">
                                            <input type="text" hidden class="form-control" id="tahun_pulang" name="tahun_pulang" value="{{ date('Y') }}">
                                            <input type="text" hidden class="form-control" id="jam_pulang" name="jam_pulang" value="{{ date('H:i:s') }}">
                                            @if($row->jam_pulang == '')
                                                <button type="submit" class="btn btn-xs btn-primary pull-right" style="margin-left:5px;">Absen Pulang</button>
                                            @else
                                            @endif
                                        </form>
                                    @else
                                    @endif
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
                                <form action="{{ route('absenlembur.validasi') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" readonly class="form-control" name="id" id="idx" class="form-control">
                                        <input type="text" readonly class="form-control" name="tukang_id" id="tukang_idx" class="form-control">
                                        <input type="text" readonly class="form-control" name="user_id" id="user_idx" class="form-control">
                                        <input type="text" readonly class="form-control" id="validasi_byx" name="validasi_by" value="{{ Auth::user()->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="picker1">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="Hadir">Hadir</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Alpa">Alpa</option>
                                            <option value="Ijin">Ijin</option>
                                            <option value="Lembur">Lembur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
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

@section('customJs')
<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var projek_id = $(this).data('projek_id');
        var tukang_id = $(this).data('tukang_id');
        var user_id = $(this).data('user_id');
        
        $('#idx').val(id);
        $('#projek_idx').val(projek_id);
        $('#tukang_idx').val(tukang_id);
        $('#user_idx').val(user_id);
      });

      $('#frm-edit').on('submit', function(e) {

      });
      
      $('#frm-tambah').on('submit', function(e) {

      });

      $('#datatable').on('click','.btn-hapus', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.confirm({
            icon: 'i-Information',
            title: 'Alert !',
            content: 'Apakah anda ingin menghapus data ini ?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: function () {
                    $.get("{{ route('absenlembur.destroy') }}", {id:id}, function(data) {
                        toastr.success('Data berhasil dihapus');
                        location.reload();
                    });
                },
                cancel: function () {
                    // $.alert('Batal!');
                },
            }
        });
      });

    });
</script>
@endsection