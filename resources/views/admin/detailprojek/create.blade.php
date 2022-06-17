@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Kerusakan</div>
            <form action="{{ route('projekdetail.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="picker1">Pilih Pekerjaan</label>
                        <select name="projek_id" class="form-control">
                            @foreach($projeks as $row)
                                <option value="{{ $row->id }}">{{ date('d-m-Y', strtotime($row['tanggal'])) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="nama_pekerjaan">Nama Pekerjaan</label>
                        <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="lokasi">Lokasi</label>
                        <select name="lokasi" class="form-control">
                            <!-- <option value="TOILET GH01 PRIA">TOILET GH01 PRIA</option>
                            <option value="TOILET DD03 PRIA">TOILET DD03 PRIA</option>
                            <option value="TOILET GH01 PRIA">TOILET GH01 PRIA</option>
                            <option value="TOILET DD06 PRIA">TOILET DD06 PRIA</option>
                            <option value="TOILET GH02 PRIA">TOILET GH02 PRIA</option>
                            <option value="TOILET GH03 PRIA">TOILET GH03 PRIA</option>
                            <option value="TOILET DD04 PRIA">TOILET DD04 PRIA</option>
                            <option value="TOILET PERKANTORAN AIRLINE PRIA">TOILET PERKANTORAN AIRLINE PRIA</option>
                            <option value="TOILET CHECKIN BARAT PRIA">TOILET CHECKIN BARAT PRIA</option>
                            <option value="TOILET GH01 WANITA">TOILET GH01 WANITA</option>
                            <option value="TOILET GH02 WANITA">TOILET GH02 WANITA</option>
                            <option value="TOILET DD03 WANITA">TOILET DD03 WANITA</option>
                            <option value="TOILET DD04 WANITA">TOILET DD04 WANITA</option>
                            <option value="TOILET DD06 WANITA">TOILET DD06 WANITA</option>
                            <option value="TOILET AD04 WANITA">TOILET AD04 WANITA</option>
                            <option value="TOILET DD03 WANITA">TOILET DD03 WANITA</option>
                            <option value="TOILET CHECKIN TENGAH DD02 WANITA">TOILET CHECKIN TENGAH DD02 WANITA</option>
                            <option value="TOILET PERKANTORAN AIRLINE WANITA">TOILET PERKANTORAN AIRLINE WANITA</option>
                            <option value="TOILET TRANSIT DOMESTIK WANITA">TOILET TRANSIT DOMESTIK WANITA</option>
                            <option value="TOILET CHECKIN TENGAH DD02">TOILET CHECKIN TENGAH DD02</option>
                            <option value="TOILET OOF01">TOILET OOF01</option>
                            <option value="TOILET GH01">TOILET GH01</option>
                            <option value="TOILET GH02">TOILET GH02</option>
                            <option value="TOILET CHECKIN BARAT DISABILITAS">TOILET CHECKIN BARAT DISABILITAS</option>
                            <option value="TOILET DD04 DISABILITAS">TOILET DD04 DISABILITAS</option> -->
                            <option value="TOILET TERMINAL DOMESTIK">TOILET TERMINAL DOMESTIK</option>
                            <option value="TOILET TERMINAL DOMESTIK">TOILET TERMINAL DOMESTIK</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="shift">Shift</label>
                        <select name="shift" class="form-control">
                            <option value="Pagi">Pagi</option>
                            <option value="Siang">Siang</option>
                            <option value="Malam">Malam</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="baik">Baik</option>
                            <option value="penggantian">Penggantian</option>
                            <option value="perbaikan_ringan">Perbaikan Ringan</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="jam">Jam</label>
                        <input type="text" readonly class="form-control" id="jam" name="jam" value="{{ date('H:i:s') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_1">Foto 1</label>
                        <input type="file" class="form-control" id="foto_1" name="foto_1" accept="image/png, image/jpg, image/jpeg" >
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="foto_2">Foto 2</label>
                        <input type="file" class="form-control" id="foto_2" name="foto_2" accept="image/png, image/jpg, image/jpeg" >
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

<script>
    $(document).ready(function() {

        const create = $('#create'),
            wrapper = $('#wrapper'),
            itemRepeat = $('[item-repeat]').html()

        create.on('click', function() {
            let io = $(document).find('#wrapper div.l-item').length

            wrapper.append(`
            <div class="row d-flex align-items-end l-item">
                ${itemRepeat}

                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <button class="btn btn-outline-danger text-nowrap px-1 delete" data="${io}" type="button">
                            <span>Delete</span>
                        </button>
                    </div>
                </div>

                
            </div> <hr id="hr-${io}">
        `)
        })

        $(document).on('click', '.delete', function() {
            $(`#hr-${$(this).attr('data')}`).remove()
            $(this).doms(3).remove()

            sum()
        })

        let subtotal = 0

        $(document).on('keyup', '.sum', function() {
            try {
                // get dom parent of this input
                let parent = $(this).doms(3)

                // find input with attribute (quantity, price & total)
                let elQty = parent.find('input[quantity]'),
                    elPrice = parent.find('input[price]'),
                    elDisc = parent.find('input[disc]'),
                    elTotal = parent.find('input[total]')

                // get value of input
                let qty = elQty.val().isEmpty() ? 0 : elQty.val(),
                    price = elPrice.val().isEmpty() ? 0 : elPrice.val(),
                    disc = elDisc.val().isEmpty() ? 0 : elDisc.val()


                // get number only
                let _qty = `${qty}`.idrToNum(),
                    _price = `${price}`.idrToNum(),
                    _disc = `${disc}`.idrToNum()

                let amount = (_qty * _price)

                let total = (amount * _disc) / 100

                // set total with calculated value
                elTotal.val(`${amount - total}`.numToIdr())

                sum()
            } catch (err) {
                console.log(`-- error : ${err}`)
            }
        })

        $('#freight_cost').on('keyup', function() {
            sum()
        })

        $('#dp').on('keyup', function() {
            sumDp()
        })

        function sum() {
            subtotal = 0

            wrapper.find('input[total]').each(function() {
                let value = `${$(this).val()}`.idrToNum()
                subtotal += Number(value)
            })

            let pph = (subtotal * 10) / 100

            $('#sub_total').val(`${subtotal}`.numToIdr())
            $('#pph').val(`${pph}`.numToIdr())

            let elFc = $('#freight_cost')
            let fc = elFc.val().isEmpty() ? 0 : elFc.val()

            let grandTotal = (subtotal + pph) + Number(`${fc}`.idrToNum())

            $('#grand_total').val(`${grandTotal}`.numToIdr())

            sumDp()
        }

        function sumDp(){
            let val = $('#dp').val()

            let grandTotal = $('#grand_total').val()

            let percDp = val.isEmpty() ? 0 : val
            let gt = `${(grandTotal.isEmpty() ? 0 : grandTotal)}`.idrToNum()

            let dp = (gt * Number(percDp)) / 100

            $('#jml_dp').val(`${dp}`.numToIdr())
        }

    })
    </script>
@endsection