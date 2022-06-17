@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Kerusakan</div>
            <form action="{{ route('projekdetail.kerusakanadd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="text" hidden class="form-control" id="id_detail_projeks" name="id_detail_projeks" value="{{ $detailprojeks->id }}">
                    <div class="col-md-6 form-group mb-3">
                        <label for="nama_kerusakan">Nama Kerusakan</label>
                        <select name="nama_kerusakan" class="form-control">
                            @foreach($list_pekerjaan as $row)
                                <option value="{{ $row->id }}">{{ $row['nama_pekerjaan'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="volume">Volume</label>
                        <input type="number" class="form-control" id="volume" name="volume" value="{{ old('volume') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="satuan">Satuan</label>
                        <select name="satuan" class="form-control">
                            <option value="M2">M2</option>
                            <option value="Can">Can</option>
                            <option value="Box">Box</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Sheet">Sheet</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto">Foto 1</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/png, image/jpg, image/jpeg" >
                    </div>

                    <!-- <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">
                            ITEM PEKERJAAN 
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary" type="button" id="create">
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span>Tambah</span>
                                    </button>
                                </div>
                            </div><br>
                            <div id="wrapper">
                                <div class="row d-flex align-items-end l-item" item-repeat>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="itemcost">Uraian Pekerjaan</label>
                                            <input type="text" class="form-control" id="itemcost" name="nama_barang[]" aria-describedby="itemcost" placeholder="Description"/>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="itemquantity">Volume</label>
                                            <input type="text" class="form-control sum" idr-format quantity maxlength="4" name="qty[]" aria-describedby="itemquantity" placeholder="Qty"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="itemquantity">Sat</label>
                                            <select name="satuan_id" class="form-control">
                                                <option>Pilih</option>
                                                <option value="2">m2</option>
                                                <option value="3">can</option>
                                                <option value="4">box</option>
                                                <option value="5">pcs</option>
                                                <option value="6">sheet</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label>Harga Satuan</label>
                                            <input type="text" name="unit_price[]" idr-format price maxlength="11" class="form-control sum" value=""/>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="staticprice">Jumlah Harga</label>
                                            <input type="text" name="amount[]" total disabled class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        </div>
                    </div>

                    
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_kerusakan_1">Foto Kerusakan 1</label>
                        <input type="file" class="form-control" id="foto_1" name="foto_1" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_kerusakan_2">Foto Kerusakan 2</label>
                        <input type="file" class="form-control" id="foto_2" name="foto_2" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_kerusakan_3">Foto Kerusakan 3</label>
                        <input type="file" class="form-control" id="foto_3" name="foto_3" accept="image/png, image/jpg, image/jpeg" >
                    </div> -->

                    <div class="col-md-12">
                        @can('projekdetail-add')
                            <button class="btn btn-primary">Submit</button>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection