@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Detail Proyek

                      <span class="pull-right">
                          <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                          <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                          
                          @can('projekdetail-add')
                            <a href="{{ route('projekdetail.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                          @endcan
                      </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama Pekerjaan</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Shift</th>
                                <th>Foto 1</th>
                                <th>Foto 2</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($detailprojeks as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($row['tanggal'])) }} {{ $row->jam }}</td>
                                <td>{{ $row->nama_pekerjaan }}</td>
                                <td>
                                    @if($row->status == 'baik')
                                        <span class="badge badge-success m-2">Baik</span>
                                    @elseif($row->status == 'penggantian')
                                        <span class="badge badge-danger m-2">Penggantian</span>
                                    @else
                                        <span class="badge badge-danger m-2">Perbaikan Ringan</span>
                                    @endif
                                </td>
                                <td>{{ $row->lokasi }}</td>
                                <td>{{ $row->shift }}</td>
                                <td>
                                    @if($row->foto_1 != '')
                                        <img class="d-block rounded" width="100%" src="{{ asset('storage/projekdetail/'. $row->foto_1) }}">
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($row->foto_2 != '')
                                        <img class="d-block rounded" width="100%" src="{{ asset('storage/projekdetail/'. $row->foto_2) }}">
                                    @else
                                    @endif
                                </td>
                                <td>{{ $row->keterangan }}</td>
                                <td>
                                    @can('projekdetail-list')
                                        <a href="{{ route('projekdetail.kerusakancreate', $row->id) }}" class="btn btn-primary btn-sm" style="margin: 2px;">Tambah Kerusakan</a>
                                        <a href="{{ route('projekdetail.kerusakan', $row->id) }}" class="btn btn-success btn-sm" style="margin: 2px;">Detail Kerusakan</a>
                                    @endcan
                                    @can('projekdetail-update')
                                        <!-- <a href="{{ route('projekdetail.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a> -->
                                    @endcan
                                    @can('projekdetail-destroy')
                                        <!-- <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row['id'] }}">Hapus</a> -->
                                        <a href="{{ route('projekdetail.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" style="margin: 2px;">Hapus</a>
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
<script type="text/javascript">

  $(document).ready(function() {
    
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
                    $.get("{{ route('projekdetail.destroy') }}", {id:id}, function(data) {
                        toastr.success('Data berhasil dihapus');
                        location.reload();
                    });
                },
                cancel: function () {
                    $.alert('Batal!');
                },
            }
        });
    });

  });
</script>
@endsection