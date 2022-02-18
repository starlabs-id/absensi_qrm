@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Detail Proyek</div>
            <form >
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Projek</label>
                        <select name="projek_id" class="form-control">
                            @foreach($projek as $row)
                                <option value="{{ $row->id }}"> {{ $row->nama_projek }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="uraian_pekerjaan">Uraian Pekerjaan</label>
                        <input type="text" class="form-control" id="uraian_pekerjaan" name="uraian_pekerjaan" required value="{{ old('uraian_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="volume_kontrak">Volume Kontrak</label>
                        <input type="text" class="form-control" id="volume_kontrak" name="volume_kontrak" required value="{{ old('volume_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" required value="{{ old('harga_satuan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="volume_pekerjaan_hari_ini">Volume Pekerjaan Hari Ini</label>
                        <input type="text" class="form-control" id="volume_pekerjaan_hari_ini" name="volume_pekerjaan_hari_ini" required value="{{ old('volume_pekerjaan_hari_ini') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="volume_dikerjakan">Volume Dikerjakan</label>
                        <input type="text" class="form-control" id="volume_dikerjakan" name="volume_dikerjakan" required value="{{ old('volume_dikerjakan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="prestasi_keuangan_hari_ini">Prestasi Keuangan Hari ini</label>
                        <input type="text" class="form-control" id="prestasi_keuangan_hari_ini" name="prestasi_keuangan_hari_ini" required value="{{ old('uraian_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="prestasi_fisik_hari_ini">Prestasi Fisik Hari Ini</label>
                        <input type="text" class="form-control" id="prestasi_fisik_hari_ini" name="prestasi_fisik_hari_ini" required value="{{ old('uraian_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ old('uraian_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" aria-label="With textarea" name="keterangan"></textarea>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_1">Foto 1</label>
                        <input type="file" class="form-control" id="foto_1" name="foto_1" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_2">Foto 2</label>
                        <input type="file" class="form-control" id="foto_2" name="foto_2" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_3">Foto 3</label>
                        <input type="file" class="form-control" id="foto_3" name="foto_3" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_4">Foto 4</label>
                        <input type="file" class="form-control" id="foto_4" name="foto_4" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_5">Foto 5</label>
                        <input type="file" class="form-control" id="foto_5" name="foto_5" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_6">Foto 6</label>
                        <input type="file" class="form-control" id="foto_6" name="foto_6" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_7">Foto 7</label>
                        <input type="file" class="form-control" id="foto_7" name="foto_7" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_8">Foto 8</label>
                        <input type="file" class="form-control" id="foto_8" name="foto_8" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_9">Foto 9</label>
                        <input type="file" class="form-control" id="foto_9" name="foto_9" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_10">Foto 10</label>
                        <input type="file" class="form-control" id="foto_10" name="foto_10" accept="image/png, image/jpg, image/jpeg" >
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