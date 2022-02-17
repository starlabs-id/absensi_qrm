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
                          <a href="{{ route('projekdetail.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                      </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Projek</th>
                                <th>Uraian Pekerjaan</th>
                                <th>Volume Kontrak</th>
                                <th>Harga Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($detailprojeks as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_projek }}</td>
                                <td>{{ $row->uraian_pekerjaan }}</td>
                                <td>{{ $row->volume_kontrak }}</td>
                                <td>{{ $row->harga_satuan }}</td>
                                <td>
                                    <a href="{{ route('projekdetail.show', $row->id) }}" class="btn btn-success btn-sm">Detail</a>
                                    <a href="{{ route('projekdetail.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row['id'] }}">Hapus</a>
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