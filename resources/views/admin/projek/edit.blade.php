@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Edit Proyek : {{ $projek->uraian_pekerjaan }}</div>
            <form action="{{ route('projek.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="uraian_pekerjaan">Uraian Pekerjaan</label>
                        <input type="hidden" name="id" value="{{ $projek['id'] }}" class="form-control" readonly>
                        <input type="text" class="form-control" id="uraian_pekerjaan" name="uraian_pekerjaan" required value="{{ old('uraian_pekerjaan', $projek->uraian_pekerjaan) }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $projek->tanggal) }}">
                    </div>

                    <div class="col-md-12">
                        @can('projek-update')
                            <button class="btn btn-primary">Submit</button>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection