@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Proyek</div>
            <form >
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="nama_projek">Nama Proyek</label>
                        <input type="text" class="form-control" id="nama_projek" name="nama_projek">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih PM</label>
                        <select class="form-control">
                            <option>Option 1</option>
                            <option>Option 1</option>
                            <option>Option 1</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Marketing</label>
                        <select class="form-control">
                            <option>Option 1</option>
                            <option>Option 1</option>
                            <option>Option 1</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Supervisor</label>
                        <select class="form-control">
                            <option>Option 1</option>
                            <option>Option 1</option>
                            <option>Option 1</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Owner</label>
                        <select class="form-control">
                            <option>Option 1</option>
                            <option>Option 1</option>
                            <option>Option 1</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="volume">Volume</label>
                        <input class="form-control" id="volume" name="volume">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="rencana_kerja">Rencana Kerja</label>
                        <input class="form-control" id="rencana_kerja" name="rencana_kerja">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input class="form-control" id="lokasi" name="lokasi">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input class="form-control" id="tanggal_mulai" name="tanggal_mulai">
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