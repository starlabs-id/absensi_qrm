@extends('layouts.master')

@section('web_title')
  {{ $konfig->web_title }}
@endsection
@section('favicon')
  {{ $konfig->favicon }}
@endsection
@section('logo')
  {{ $konfig->logo }}
@endsection

@section('content')
<div class="row">

  <div class="col-md-12 mb-4">
    <div class="card mb-4">
      <div class="card-body">
        
        <h4 class="card-title mb-3">
          Data Profile
        </h4>
        <br>

        <form method="post" id="frm-tambah" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
          {{ csrf_field() }}

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <!-- <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}" placeholder="Email" readonly>
            </div> -->
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $user['name'] }}" required>
              <div class="invalid-feedback">
                  Masukkan Nama, Minimum 5 Characters, Maximum 30 Characters!
              </div>
            </div>
            <div class="form-group">
                <label>Titel</label>
                <select name="titel" id="titel" class="form-control select2" style="width: 100% !important">
                    <option disabled="" selected="">--Pilih Titel--</option>
                    <option value="Bapak" {{ $user['titel'] =='Bapak' ? 'selected' : ''  }}>Bapak</option>
                    <option value="Ibu" {{ $user['titel'] =='Ibu' ? 'selected' : ''  }}>Ibu</option>
                    <option value="Saudara" {{ $user['titel'] =='Saudara' ? 'selected' : ''  }}>Saudara</option>
                    <option value="Saudari" {{ $user['titel'] =='Saudari' ? 'selected' : ''  }}>Saudari</option>
                </select>
            </div>
            <div class="form-group">
              <label for="no_telp_hp">No. Telepon</label>
              <input type="number" min="0" class="form-control" placeholder="No. Telepon" value="{{ $user['no_telp_hp'] }}" readonly>
              <input type="number" min="0" class="form-control" id="no_telp_hp" name="no_telp_hp" placeholder="No. Telepon">
              <div class="invalid-feedback">
                  Masukkan No. Telepon, Minimum 1 Characters, Maximum 16 Characters!
              </div>
              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <!-- <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{ $user['alamat'] }}">
              <div class="invalid-feedback">
                  Masukkan Alamat, Minimum 1 Characters, Maximum 400 Characters!
              </div>
            </div> -->
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" id="myInput" class="form-control" placeholder="Masukkan Password" maxlength="30">
              <input type="checkbox" onclick="myFunction()"> <label>Show Password</label>
              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input name="confirm-password" type="password" id="myInput1" class="form-control" placeholder="Masukkan Konfirmasi Password" maxlength="30">
              <input type="checkbox" onclick="myFunction1()"> <label>Show Password</label>
              <label style="font-style: italic; color: #aaa;" class="pull-right">Biarkan kosong bila tidak ingin mengganti</label>
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <br>
            <center><button type="submit" class="btn btn-flat btn-success">Simpan</button></center>
          </div>

          <br><br>
      </form>
        
      </div>
    </div>
  </div>
  <!-- end of col -->


</div>
@endsection

@section('customJs')
<script type="text/javascript">

  Filevalidation = () => { 
      const fi = document.getElementById('foto'); 
      // Check if any file is selected. 
      if (fi.files.length > 0) { 
          for (const i = 0; i <= fi.files.length - 1; i++) { 
              const fsize = fi.files.item(i).size; 
                  const file = Math.round((fsize / 1024)); 
                  // The size of the file. 
                  if (file >= 2048) { 
                  // toastr.error("File Image 1 lebih dari 2MB, Harap ganti!");
                  Swal.fire({
                      // icon: 'warning',
                      title: 'Oops...',
                      text: 'File foto lebih dari 2MB, Harap ganti!',
                      timer: 2200,
                  });
                  document.getElementById('logo').value = "";
              }
          } 
      }
  }
  

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

  //HTML5 File API preview locally on browser
  function renderImage(file, el) {

  // instantiate FileReader object
  var reader = new FileReader();

  // change img preview placeholder src (input file id exp: main_img, preview img id exp : main_img_preview)
  reader.onload = function(e) { //e.target is the FileReader obj, and the actual file is e.target.result.
    $('#' + el.id + '_preview').attr('src', e.target.result);
  }

  // when the file is read it triggers the onload event above.
  reader.readAsDataURL(file);
  }

  $(".foto").change(function(e) {
  var el = e.target;
  renderImage(this.files[0], el);
  });
</script>
@endsection
