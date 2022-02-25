@extends('layouts.master')

@section('content')
<div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
                <h4 class="card-title mb-3">
                    Detail Proyek
                    <span class="pull-right">
                        <button class="btn btn-warning btn-sm pull-right">
                            <a href="{{ route('proyek.index') }}">Kembali</a>
                        </button>
                    </span>
                </h4>
                <br>
                <div class="row">
                    @if($detailprojeks->foto_1 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_1) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_2 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_2) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_3 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_3) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_4 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_4) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_5 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_5) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_6 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_6) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_7 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_7) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_8 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_8) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_9 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_9) }}">
                        </div>
                    @else
                    @endif
                    @if($detailprojeks->foto_10 != '')
                        <div class="col-lg-3 col-xl-3 mt-3">
                            <img class="d-block w-100 rounded rounded" src="{{ asset('storage/projekdetail/'. $detailprojeks->foto_10) }}">
                        </div>
                    @else
                    @endif
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1">Nama Proyek</p>
                                <span>{{ $detailprojeks->nama_projek }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Uraian Pekerjaan</p>
                                <span>{{ $detailprojeks->uraian_pekerjaan }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Volume Kontrak</p>
                                <span>{{ $detailprojeks->volume_kontrak }} ㎡</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1">Volume Dikerjakan</p>
                                <span>{{ $detailprojeks->volume_dikerjakan }} ㎡</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Prestasi Keuangan Hari ini</p>
                                <span>Rp. {{ number_format($detailprojeks->prestasi_fisik_hari_ini, 2, ',', '.') }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Keterangan</p>
                                <span>{{ $detailprojeks->keterangan }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1">Harga Satuan</p>
                                <span>Rp. {{ number_format($detailprojeks->harga_satuan, 2, ',', '.') }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Volume Pekerjaan Hari Ini</p>
                                <span>{{ $detailprojeks->volume_pekerjaan_hari_ini }} ㎡</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mb-4">
                                <p class="text-primary mb-1">Prestasi Fisik Hari Ini</p>
                                <span>Rp. {{ number_format($detailprojeks->prestasi_keuangan_hari_ini, 2, ',', '.') }}</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">Tanggal</p>
                                <span>{{ date('d/m/Y', strtotime($detailprojeks['tanggal'])) }}</span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>    

@endsection