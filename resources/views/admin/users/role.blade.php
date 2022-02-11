@extends('layouts.master')

@section('content')
<div class="row">

  <div class="col-md-12 mb-4">
      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title mb-3">
            Data Role

              <span class="pull-right">
                <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah"><i class="nav-icon i-Add"></i> Tambah Role</a>
              </span>
          </h4>
          <br>

          <div class="collapse" id="collapse-tambah">
  			    <div class="well">
  			      <form method="post" id="frm-tambah" action="{{ route('role.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
  			      {{ csrf_field() }}

                <div class="col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" required>
                    <div class="invalid-feedback">
                        Masukkan Nama, Minimum 5 Characters, Maximum 20 Characters!
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                  <label>Role</label><br>
                  <div class="row">
                    <!-- $permission->split($permission->count()/3) as $rows -->
                    @foreach($permission->split($permission->count()) as $rows)
                    <div class="col-lg-4" data-aos="fade-right" data-aos-duration="2000">
                      @foreach($rows as $row)
                        <label class="checkbox checkbox-success">
                          <input type="checkbox" name="permission[]" multiple="multiple" value="{{Str::limit($row->id, 15)}}"> {{Str::limit($row->name)}}<br>
                          <span class="checkmark"></span>
                        </label>
                      @endforeach
                    </div>
                    @endforeach
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
              <th>Name</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          	<?php $no = 1; ?>
            @foreach($datarole as $row)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->name }}</td>
                  <td>
                      <a href="{{ route('role.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                    $.get("{{ route('role.destroy') }}", {id:id}, function(data) {
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
