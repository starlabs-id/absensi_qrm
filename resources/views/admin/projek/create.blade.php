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
                        <label for="nama_projek">Nama Proyek</label>
                        <input type="text" class="form-control" id="nama_projek" name="nama_projek" required value="{{ old('nama_projek') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="kode_projek">Kode Proyek</label>
                        <input type="text" class="form-control" id="kode_projek" name="kode_projek" required value="{{ old('kode_projek') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="area_projek">Area Proyek</label>
                        <input type="text" class="form-control" id="area_projek" name="area_projek" required value="{{ old('area_projek') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="nomor_kontrak">Nomor Kontrak</label>
                        <input type="text" class="form-control" id="nomor_kontrak" name="nomor_kontrak" required value="{{ old('nomor_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_kontrak">Tanggal Kontrak</label>
                        <input type="date" class="form-control" id="tanggal_kontrak" name="tanggal_kontrak" required value="{{ old('tanggal_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="judul_kontrak">Judul Kontrak</label>
                        <input type="text" class="form-control" id="judul_kontrak" name="judul_kontrak" required value="{{ old('judul_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="nilai_kontrak">Nilai Kontrak</label>
                        <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" required value="{{ old('nilai_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="durasi_kontrak">Durasi Kontrak</label>
                        <input type="text" class="form-control" id="durasi_kontrak" name="durasi_kontrak" required value="{{ old('durasi_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="durasi_projek">Durasi Proyek</label>
                        <input type="text" class="form-control" id="durasi_projek" name="durasi_projek" required value="{{ old('durasi_projek') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required value="{{ old('lokasi') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="pemberi_kerja">Pemberi Kerja</label>
                        <input type="text" class="form-control" id="pemberi_kerja" name="pemberi_kerja" required value="{{ old('pemberi_kerja') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="rencana_kerja">Rencana Kerja</label>
                        <input type="text" class="form-control" id="rencana_kerja" name="rencana_kerja" required value="{{ old('rencana_kerja') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih PM</label>
                        <select name="pm" id="" class="form-control">
                            @foreach($pm as $row)
                                <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Marketing</label>
                        <select name="marketing" id="" class="form-control">
                            @foreach($marketing as $row)
                                <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Supervisor</label>
                        <select name="supervisor" id="" class="form-control">
                            @foreach($supervisor as $row)
                                <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Owner</label>
                        <select name="owner" id="" class="form-control">
                            @foreach($owner as $row)
                                <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required value="{{ old('tanggal_mulai') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required value="{{ old('tanggal_selesai') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_volume_kontrak">Total Volume Kontrak</label>
                        <input type="number" class="form-control" id="total_volume_kontrak" name="total_volume_kontrak" required value="{{ old('total_volume_kontrak') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_harga_satuan">Total Harga Satuan</label>
                        <input type="number" class="form-control" id="total_harga_satuan" name="total_harga_satuan" required value="{{ old('total_harga_satuan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_volume_pekerjaan_hari_ini">Total Volume Pekerjaan Hari Ini</label>
                        <input class="form-control" id="total_volume_pekerjaan_hari_ini" name="total_volume_pekerjaan_hari_ini" required value="{{ old('total_volume_pekerjaan_hari_ini') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_pekerja">Total Pekerja</label>
                        <input type="number" min="0" class="form-control" id="total_pekerja" name="total_pekerja" required value="{{ old('total_pekerja') }}">
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