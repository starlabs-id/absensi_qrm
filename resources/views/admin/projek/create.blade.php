@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Proyek</div>
            <form action="{{ route('projek.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="uraian_pekerjaan">Uraian Pekerjaan</label>
                        <input type="text" class="form-control" id="uraian_pekerjaan" name="uraian_pekerjaan" value="{{ old('uraian_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                    </div>

                    <div class="col-md-12">
                        @can('projek-add')
                            <button class="btn btn-primary">Submit</button>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection