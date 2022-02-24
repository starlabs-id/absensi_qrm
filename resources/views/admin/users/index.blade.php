@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Users
                      @can('user-add')
                      <span class="pull-right">
                          <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                          <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                          <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">Tambah User</a>
                      </span>
                      @endcan
                </h4>
                <br>
                
                <div class="collapse" id="collapse-tambah">
                    <div class="well">
                        <form method="post" id="frm-tambah" action="{{ route('user.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                  <div class="invalid-feedback">
                                      Masukkan Email!
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                                  <div class="invalid-feedback">
                                      Masukkan Nama!
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>No. Telepon</label>
                                  <input type="number" min="0" class="form-control" id="no_telp_hp" name="no_telp_hp" placeholder="No. Telepon" value="{{ old('no_telp_hp') }}" required>
                                  <div class="invalid-feedback">
                                      Masukkan No. Telepon!
                                  </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <label>Role</label>
                                  <select name="roles" class="form-control" style="width: 100% !important">
                                      <!-- <option readonly selected="">--Pilih Role--</option> -->
                                      @foreach($role as $key => $name)
                                          <option value="{{$key}}"> {{$name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Password</label>
                                  <input name="password" type="password" id="myInput" class="form-control" placeholder="Masukkan Password" maxlength="30">
                                  <!-- <input type="checkbox" onclick="myFunction()"> <label>Show Password</label> -->
                                </div>
                                <div class="form-group">
                                  <label>Confirm Password</label>
                                  <input name="confirm-password" type="password" id="myInput1" class="form-control" placeholder="Masukkan Konfirmasi Password" maxlength="30">
                                  <!-- <input type="checkbox" onclick="myFunction1()"> <label>Show Password</label> -->
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp/HP</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                          @foreach($users as $key => $row)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->namea }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->no_telp_hp }}</td>
                            <td>
                              @if(!empty($row->getRoleNames()))
                                @foreach($row->getRoleNames() as $v)
                                  <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                              @endif
                            </td>
                            <td>
                              @can('user-update')
                                <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-sm btn-edit"
                                  data-id="{{ $row['id'] }}"
                                  data-hidden_id="{{ $row['id'] }}"
                                  data-no_telp_hp="{{ $row['no_telp_hp'] }}"
                                  data-namea="{{ $row['namea'] }}"
                                  data-ris="{{ $row['ris'] }}"><i class="nav-icon i-Pen-5"></i> Edit
                                </a>
                              @endcan
                              @can('user-destroy')
                                <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row['id'] }}"><i class="nav-icon i-Remove"></i> Hapus</a>
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
                        <form action="{{ route('user.update') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group" hidden>
                              <label>ID</label>
                              <input type="text" id="idx" name="id" class="form-control" placeholder="ID" required>
                              <input type="text" name="hidden_id" id="hidden_idx"/>
                            </div>
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" class="form-control" id="nameax" name="name" placeholder="Nama" required>
                              <div class="invalid-feedback">
                                  Masukkan Nama, Minimum 5 Characters, Maximum 30 Characters!
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" placeholder="Email">
                              <div class="invalid-feedback">
                                  Masukkan Email, Minimum 5 Characters, Maximum 30 Characters!
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="no_telp_hp">No. Telepon</label>
                              <input type="number" min="0" class="form-control" name="no_telp_hp" placeholder="No. Telepon">
                              <div class="invalid-feedback">
                                  Masukkan No. Telepon, Minimum 1 Characters, Maximum 16 Characters!
                              </div>
                              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input style="margin-bottom: -15px;" type="password" name="password" class="form-control" placeholder="Masukkan Password" id="myInput2"/><br>
                              <!-- <input type="checkbox" onclick="myFunction2()"> <label>Show Password</label> -->
                              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
                            </div>
                            <div class="form-group">
                              <label>Confirm Password</label>
                              <input style="margin-bottom: -15px;" type="password" name="confirm-password" class="form-control" placeholder="Masukkan Password Konfirmasi" id="myInput3" /><br>
                              <!-- <input type="checkbox" onclick="myFunction3()"> <label>Show Password</label> -->
                              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
                            </div>
                            <div class="form-group">
                              <label>Role</label>
                              <select name="roles" id="risx" class="form-control" style="width: 100% !important">
                                  <!-- <option readonly selected="">--Pilih Role--</option> -->
                                  @foreach($roles as $row)
                                      <option value="{{ $row->id }}"> {{ $row->name }}</option>
                                  @endforeach
                              </select>
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
        var hidden_id = $(this).data('hidden_id');
        var namea = $(this).data('namea');
        var ris = $(this).data('ris');
        var no_telp_hp = $(this).data('no_telp_hp');
        
        $('#nameax').val(namea);
        $('#risx').val(ris);
        $('#idx').val(id);
        $('#no_telp_hpx').val(no_telp_hp);
        $('#hidden_idx').val(hidden_id);
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
                      $.get("{{ route('user.destroy') }}", {id:id}, function(data) {
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

    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
    function myFunction1() {
        var x = document.getElementById("myInput1");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
    function myFunction2() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
    function myFunction3() {
        var x = document.getElementById("myInput1");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
</script>
@endsection