@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Tukang

                    @can('tukang-add')
                        <span class="pull-right">
                            <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">Tambah</a>
                        </span>
                    @endcan
                </h4>
                <br>
                
                <div class="collapse" id="collapse-tambah">
                    <div class="well">
                        <form method="post" id="frm-tambah" action="{{ route('tukang.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="picker1">Pilih Projek</label>
                                    <select name="projek_id" class="form-control">
                                        @foreach($projeks as $row)
                                            <option value="{{ $row->id }}"> {{ $row->nama_projek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Projek</label>
                                    <select name="tukang_id" class="form-control">
                                        @foreach($karyawan as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Shift</label>
                                    <select name="shift_id" class="form-control">
                                        @foreach($shifts as $row)
                                            <option value="{{ $row->id }}"> {{ $row->nama_shift }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="biaya_harian">Biaya Harian</label>
                                    <input type="text" class="form-control" id="biaya_harian" name="biaya_harian" value="125000" required>
                                </div>
                                <div class="form-group">
                                    <label for="biaya_lembur">Biaya Lembur</label>
                                    <input type="text" class="form-control" id="biaya_lembur" name="biaya_lembur" value="15000" required>
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
                                <th>Nama Proyek</th>
                                <th>Karyawan</th>
                                <th>Shift</th>
                                <th>Biaya Harian</th>
                                <th>Biaya Lembur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($tukangs as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_projek }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->nama_shift }}</td>
                                <td>Rp. {{ number_format($row->biaya_harian, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($row->biaya_lembur, 2, ',', '.') }}</td>
                                <td>
                                    @can('tukang-destroy')
                                        <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row->id }}">Hapus</a>
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
      $('#datatable').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var projek_id = $(this).data('projek_id');
        var biaya_harian = $(this).data('biaya_harian');
        var biaya_lembur = $(this).data('biaya_lembur');
        
        $('#id').val(id);
        $('#projek_idx').val(projek_id);
        $('#biaya_harianx').val(biaya_harian);
        $('#biaya_lemburx').val(biaya_lembur);
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
                    $.get("{{ route('tukang.destroy') }}", {id:id}, function(data) {
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