@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Edit Chat</div>
            <form >
                <div class="row">
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Proyek</label>
                        <select class="form-control">
                            <option>Proyek 1</option>
                            <option>Proyek 2</option>
                            <option>Proyek 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Direktur Utama</label>
                        <select class="form-control">
                            <option>Dirut 1</option>
                            <option>Dirut 2</option>
                            <option>Dirut 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Super Admin</label>
                        <select class="form-control">
                            <option>Super Admin 1</option>
                            <option>Super Admin 2</option>
                            <option>Super Admin 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Owner</label>
                        <select class="form-control">
                            <option>Owner 1</option>
                            <option>Owner 2</option>
                            <option>Owner 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Direktur Teknik</label>
                        <select class="form-control">
                            <option>Direktur Teknik 1</option>
                            <option>Direktur Teknik 2</option>
                            <option>Direktur Teknik 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Admin Teknik</label>
                        <select class="form-control">
                            <option>Admin Teknik 1</option>
                            <option>Admin Teknik 2</option>
                            <option>Admin Teknik 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Project Manager</label>
                        <select class="form-control">
                            <option>Project Manager 1</option>
                            <option>Project Manager 2</option>
                            <option>Project Manager 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Marketing</label>
                        <select class="form-control">
                            <option>Marketing 1</option>
                            <option>Marketing 2</option>
                            <option>Marketing 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">General Manager</label>
                        <select class="form-control">
                            <option>General Manager 1</option>
                            <option>General Manager 2</option>
                            <option>General Manager 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">CO - General Manager</label>
                        <select class="form-control">
                            <option>CO - General Manager 1</option>
                            <option>CO - General Manager 2</option>
                            <option>CO - General Manager 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Supervisor</label>
                        <select class="form-control">
                            <option>Supervisor 1</option>
                            <option>Supervisor 2</option>
                            <option>Supervisor 3</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-12 form-group mb-3">
                        <label for="biaya_harian">Biaya Harian</label>
                        <input type="text" class="form-control" id="biaya_harian" name="biaya_harian" required>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="biaya_lembur">Biaya Lembur</label>
                        <input type="text" class="form-control" id="biaya_lembur" name="biaya_lembur" required>
                    </div> -->
                    <!-- <div class="col-md-6 form-group mb-3">
                        <label for="nomor_kontrak">Nomor Kontrak</label>
                        <input type="text" class="form-control" id="nomor_kontrak" name="nomor_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_kontrak">Tanggal Kontrak</label>
                        <input type="date" class="form-control" id="tanggal_kontrak" name="tanggal_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="judul_kontrak">Judul Kontrak</label>
                        <input type="text" class="form-control" id="judul_kontrak" name="judul_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="nilai_kontrak">Nilai Kontrak</label>
                        <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="durasi_kontrak">Durasi Kontrak</label>
                        <input type="text" class="form-control" id="durasi_kontrak" name="durasi_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="durasi_projek">Durasi Proyek</label>
                        <input type="text" class="form-control" id="durasi_projek" name="durasi_projek" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="pemberi_kerja">Pemberi Kerja</label>
                        <input type="text" class="form-control" id="pemberi_kerja" name="pemberi_kerja" required>
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
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_volume_kontrak">Total Volume Kontrak</label>
                        <input class="form-control" id="total_volume_kontrak" name="total_volume_kontrak" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_harga_satuan">Total Harga Satuan</label>
                        <input class="form-control" id="total_harga_satuan" name="total_harga_satuan" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_volume_pekerjaan_sebelumnya">Total Volume Pekerjaan Sebelumnya</label>
                        <input class="form-control" id="total_volume_pekerjaan_sebelumnya" name="total_volume_pekerjaan_sebelumnya" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_volume_pekerjaan_hari_ini">Total Volume Pekerjaan Hari Ini</label>
                        <input class="form-control" id="total_volume_pekerjaan_hari_ini" name="total_volume_pekerjaan_hari_ini" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_prestasi_keuangan">Total Prestasi Keuangan</label>
                        <input class="form-control" id="total_prestasi_keuangan" name="total_prestasi_keuangan" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="total_prestasi_fisik">Total Prestasi Fisik</label>
                        <input class="form-control" id="total_prestasi_fisik" name="total_prestasi_fisik" required>
                    </div> -->

                    <div class="col-md-12">
                            <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection