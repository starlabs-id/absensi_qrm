@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data List Pekerjaan

                    <span class="pull-right">
                        @can('listpekerjaan-add')
                            <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">Tambah</a>
                        @endcan
                    </span>
                </h4>
                <br>
                
                <div class="collapse" id="collapse-tambah">
                    <div class="well">
                        <form method="post" id="frm-tambah" action="{{ route('list_pekerjaan.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nama_pekerjaan">Nama List Pekerjaan</label>
                                    <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-flat btn-success btn-block">Simpan</button>
                            </div>

                            <br><br>  
                        
                        </form>
                    </div>
                </div>

                <br>                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama List Pekerjaan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($listpekerjaan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_pekerjaan }}</td>
                                    <td>Rp. {{ number_format($row->harga, 2, ',', '.') }}</td>
                                    <td>
                                        @can('listpekerjaan-update')
                                            <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $row->id }}"
                                            data-nama_pekerjaan="{{ $row->nama_pekerjaan }}"
                                            data-harga="{{ $row->harga }}">Edit
                                            </a>
                                        @endcan
                                        @can('listpekerjaan-destroy')
                                            <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row->id }}">Hapus</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                {{-- Modal Edit --}}
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('list_pekerjaan.update') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pekerjaan">Nama List Pekerjaan</label>
                                        <input type="text" class="form-control" id="nama_pekerjaanx" name="nama_pekerjaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control" id="hargax" name="harga" required>
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
        var nama_pekerjaan = $(this).data('nama_pekerjaan');
        var harga = $(this).data('harga');
        
        $('#id').val(id);
        $('#nama_pekerjaanx').val(nama_pekerjaan);
        $('#hargax').val(harga);
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
                    $.get("{{ route('list_pekerjaan.destroy') }}", {id:id}, function(data) {
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