@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Validasi Absen</div>
            <br><br>
            <form >
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="projek_id">Projek</label>
                        <input type="hidden" readonly class="form-control" id="id" name="id" value="">
                        <input type="hidden" readonly class="form-control" id="validasi_by" name="validasi_by" value="{{ Auth::user()->id }}">
                        <input type="text" readonly class="form-control" id="projek_id" name="projek_id" value="">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Status</label>
                        <select class="form-control">
                            <option>Hadir</option>
                            <option>Sakit</option>
                            <option>Alpa</option>
                            <option>Ijin</option>
                            <option>Lembur</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" readonly class="form-control" id="keterangan" name="keterangan"></textarea>
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