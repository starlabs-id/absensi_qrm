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
          Edit Role

          <span class="pull-right">
            <a href="{{ route('role.index') }}" class="btn btn-warning btn-sm pull-right">
              <i class="nav-icon i-Arrow-Back-3"></i> Kembali
            </a>
          </span>
          <br><br>
        </h4>
        <br>

        <form method="post" action="{{ route('role.update') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
        {{ csrf_field() }}

          <div class="col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="name">Nama</label>
              <input name="id" type="text" class="form-control" value="{{ $role->id }}" hidden>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $role->name }}" required>
              <div class="invalid-feedback">
                  Masukkan Nama, Minimum 5 Characters, Maximum 20 Characters!
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-xs-12">
            <label>Role</label><br>
            <div class="row">
              @foreach($permission->split($permission->count()) as $rows)
              <div class="col-lg-3">
                @foreach($rows as $row)
                  <label class="checkbox checkbox-success">
                    <input type="checkbox" name="permission[]" multiple="multiple" value="{!! str_limit($row['id'], 15) !!}" {!! in_array($row->id, $roles) ? 'checked' : '' !!}> {{ $row['name'] }} <br>
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
  <!-- end of col -->

</div>
@endsection

@section('customJs')
@endsection
