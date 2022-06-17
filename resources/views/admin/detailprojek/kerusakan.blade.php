@extends('layouts.master')

@section('content')
<div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
                <h4 class="card-title mb-3">
                    Detail Kerusakan
                    <span class="pull-right">
                        <button onclick="goBack()" style="margin-right: 5px;" class="btn btn-warning btn-sm pull-right">
                            Kembali
                        </button>
                    </span>
                </h4>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kerusakan</th>
                                <th>Foto</th>
                                <th>Harga</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($jenis_kerusakan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_pekerjaan }}</td>
                                <td>
                                    <img class="d-block" width="50%" src="{{ asset('storage/foto_kerusakan/'. $row->foto) }}">
                                </td>
                                <td>Rp. {{ number_format($row->harga, 2, ',', '.') }}</td>
                                <td>{{ $row->volume }}</td>
                                <td>{{ $row->satuan }}</td>
                                <td>Rp. {{ number_format($row->total_harga, 2, ',', '.') }}</td>
                                <td>
                                    @can('projekdetail-update')
                                        <!-- <a href="{{ route('projekdetail.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a> -->
                                    @endcan
                                    @can('projekdetail-destroy')
                                        <!-- <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row['id'] }}">Hapus</a> -->
                                        <a href="{{ route('projekdetail.kerusakandelete', $row->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <br>
                <div class="row">
                    @foreach($foto_kerusakan as $row)
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/foto_kerusakan/'. $row->foto) }}">
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
</div>    

@endsection