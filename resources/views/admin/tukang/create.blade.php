@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Tukang</div>
            <form >
                <div class="row">
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Pilih Projek</label>
                        <select name="projek_id" class="form-control">
                            @foreach($projeks as $row)
                                <option value="{{ $row->id }}"> {{ $row->nama_projek }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="picker1">Pilih Karyawan</label>
                        <select name="user_id" class="form-control">
                            @foreach($karyawan as $row)
                                <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="biaya_harian">Biaya Harian</label>
                        <input type="text" class="form-control" id="biaya_harian" name="biaya_harian" value="125000" required>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="biaya_lembur">Biaya Lembur</label>
                        <input type="text" class="form-control" id="biaya_lembur" name="biaya_lembur" value="15000" required>
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