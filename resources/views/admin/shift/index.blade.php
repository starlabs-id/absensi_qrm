@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Shift

                    <span class="pull-right">
                        @can('shift-add')
                            <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">Tambah</a>
                        @endcan
                    </span>
                </h4>
                <br>
                
                <div class="collapse" id="collapse-tambah">
                    <div class="well">
                        <form method="post" id="frm-tambah" action="{{ route('shift.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nama_shift">Nama Shift</label>
                                    <input type="text" class="form-control" id="nama_shift" name="nama_shift" value="{{ old('nama_shift') }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="jam_masuk">Jam Masuk</label>
                                    <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jam_pulang">Jam Pulang</label>
                                    <input type="text" class="form-control" id="jam_pulang" name="jam_pulang" value="{{ old('jam_pulang') }}" required>
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
                                <th>Nama Shift</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($shifts as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_shift }}</td>
                                    <td>{{ $row->jam_masuk }}</td>
                                    <td>{{ $row->jam_pulang }}</td>
                                    <td>
                                        @can('shift-update')
                                            <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $row->id }}"
                                            data-nama_shift="{{ $row->nama_shift }}"
                                            data-jam_masuk="{{ $row->jam_masuk }}"
                                            data-jam_pulang="{{ $row->jam_pulang }}">Edit
                                            </a>
                                        @endcan
                                        @can('shift-destroy')
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
                                <form action="{{ route('shift.update') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_shift">Nama Shift</label>
                                        <input type="text" class="form-control" id="nama_shiftx" name="nama_shift" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_masuk">Jam Masuk</label>
                                        <input type="text" class="form-control" id="jam_masukx" name="jam_masuk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_pulang">Jam Pulang</label>
                                        <input type="text" class="form-control" id="jam_pulangx" name="jam_pulang" required>
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
        var nama_shift = $(this).data('nama_shift');
        var jam_masuk = $(this).data('jam_masuk');
        var jam_pulang = $(this).data('jam_pulang');
        
        $('#id').val(id);
        $('#nama_shiftx').val(nama_shift);
        $('#jam_masukx').val(jam_masuk);
        $('#jam_pulangx').val(jam_pulang);
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
                    $.get("{{ route('shift.destroy') }}", {id:id}, function(data) {
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