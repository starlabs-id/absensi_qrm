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
                        <form method="post" id="frm-nota" action="{{ route('absenlembur.create') }}" enctype="multipart/form-data" class="pull-right">
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
                                <th>Foto</th>
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
                                        <img src="{{ asset('storage/absenlembur/' . $row->foto) }}" style="width:40%">
                                        <img src="{{ asset('ttd_lembur/' . $row->ttd) }}" style="width:40%">
                                    @else
                                    @endif
                                </td>
                                <td>{{ $row->hari_datang }}, {{ $row->tanggal_datang }}</td>
                                <td>{{ $row->jam_datang }}</td>
                                <td>{{ $row->jam_pulang }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>Rp. {{ number_format($row->total_biaya_lembur, 2, ',', '.') }}</td>
                                <td>
                                    <a href="#!" class="btn btn-danger btn-xs btn-hapus pull-right" style="margin-left:5px;" data-id="{{ $row->id }}">Hapus</a>
                                    @if($row->validasi_by == '')
                                        <a href="#modal-edit" data-toggle="modal" class="btn btn-success btn-xs btn-edit pull-right" style="margin-left:5px;"
                                            data-id="{{ $row->id }}"
                                            data-projek_id="{{ $row->projek_id }}">Validasi
                                        </a>
                                    @else
                                    @endif
                                    <form method="post" action="{{ route('absenlembur.update') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" hidden class="form-control" name="id" value="{{ $row['id'] }}">
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
        
        $('#idx').val(id);
        $('#projek_idx').val(projek_id);
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
            }
        });
      });

    });
</script>
@endsection