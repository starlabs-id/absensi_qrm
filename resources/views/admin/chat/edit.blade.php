@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Edit Chat</div>
            <form action="{{ route('chat.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Projek</label>
                        <input type="hidden" name="id" value="{{ $chats['id'] }}" class="form-control" readonly>
                        <select name="projek_id" id="" class="form-control">
                            @foreach($projeks as $a)
                                <option value="{{ $a->id }}" @if($chats["projek_id"]==$a['id']) selected @endif>{{ $a->nama_projek }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Superadmin</label>
                        <select name="superadmin" id="" class="form-control">
                            @foreach($superadmin as $a)
                                <option value="{{ $a->id }}" @if($chats["superadmin"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Direktur Utama</label>
                        <select name="direktur_utama" id="" class="form-control">
                            @foreach($direktur_utama as $a)
                                <option value="{{ $a->id }}" @if($chats["direktur_utama"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Direktur Teknik</label>
                        <select name="direktur_teknik" id="" class="form-control">
                            @foreach($direktur_teknik as $a)
                                <option value="{{ $a->id }}" @if($chats["direktur_teknik"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Admin Teknik</label>
                        <select name="admin_teknik" id="" class="form-control">
                            @foreach($admin_teknik as $a)
                                <option value="{{ $a->id }}" @if($chats["admin_teknik"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Marketing</label>
                        <select name="marketing" id="" class="form-control">
                            @foreach($marketing as $a)
                                <option value="{{ $a->id }}" @if($chats["marketing"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">GM</label>
                        <select name="gm" id="" class="form-control">
                            @foreach($gm as $a)
                                <option value="{{ $a->id }}" @if($chats["gm"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Co GM</label>
                        <select name="co_gm" id="" class="form-control">
                            @foreach($co_gm as $a)
                                <option value="{{ $a->id }}" @if($chats["co_gm"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">PM</label>
                        <select name="pm" id="" class="form-control">
                            @foreach($pm as $a)
                                <option value="{{ $a->id }}" @if($chats["pm"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Supervisor</label>
                        <select name="supervisor" id="" class="form-control">
                            @foreach($supervisor as $a)
                                <option value="{{ $a->id }}" @if($chats["supervisor"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Owner</label>
                        <select name="owner" id="" class="form-control">
                            @foreach($owner as $a)
                                <option value="{{ $a->id }}" @if($chats["owner"]==$a['id']) selected @endif>{{ $a->namea }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection