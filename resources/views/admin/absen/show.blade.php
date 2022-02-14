@extends('layouts.master')

@section('content')
<div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
            <h4 class="card-title mb-3">
                    Detail Projek
                    <span class="pull-right">
                        <button class="btn btn-warning btn-sm pull-right">
                            <a href="{{ route('admin.projek.index') }}">Kembali</a>
                        </button>
                    </span>
                </h4>

                <div id="smartwizard" class="col-md-12">
                    <ul>
                        <li>
                            <a href="#data">Data</a>
                        </li>
                        <li>
                            <a href="#detail_harian">Detail Harian</a>
                        </li>
                        <li>
                            <a href="#tukang">Daftar Tukang</a>
                        </li>
                        <li>
                            <a href="#chat">Chat</a>
                        </li>
                    </ul>


                    <div>
                        <div id="data">
                            <h4>Data</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Nama Proyek</p>
                                        <span>AAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Kode Proyek</p>
                                        <span>AAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Nomor Kontrak</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Kontrak</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Selesai</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Prestasi Fisik</p>
                                        <span>AAAA</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Judul Kontrak</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Nilai Kontrak</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Durasi Kontrak</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Durasi Proyek</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Volume Pekerjaan Sebelumnya</p>
                                        <span>AAAA</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Lokasi</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Pemberi Kerja</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">PM</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Marketing</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Volume Pekerjaan Hari Ini</p>
                                        <span>AAAA</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Supervisor</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Rencana Kerja</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Owner</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Mulai</p>
                                        <span>AAAA</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Prestasi Keuangan</p>
                                        <span>AAAA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="detail_harian">
                            <h4>Detail Harian</h4>
                            <br>
                            <div class="table-responsive">
                                <table id="alternative_pagination_table" class="display table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Uraian Pekerjaan</th>
                                            <th>Volume Kontrak</th>
                                            <th>Harga Satuan</th>
                                            <th>Volume Pekerjaan Hari Ini</th>
                                            <th>Volume Dikerjakan</th>
                                            <th>Prestasi Keuangan Hari Ini</th>
                                            <th>Prestasi Fisik Hari Ini</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="tukang">
                            <h4>Daftar Tukang</h4>
                            <br>
                            <div class="table-responsive">
                                <table id="" class="display table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Tukang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="chat">
                            <h4>Chat</h4>
                            <br>
                            
                            <div data-sidebar-container="chat" class="card chat-sidebar-container">
                                
                                <div data-sidebar-content="chat" class="chat-content-wrap">

                                    <div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true">
                                        <div class="d-flex mb-4">
                                            <div class="message flex-grow-1">
                                                <div class="d-flex">
                                                    <p class="mb-1 text-title text-16 flex-grow-1">Frank Powell</p>
                                                    <span class="text-small text-muted">25 min ago</span>
                                                </div>
                                                <p class="m-0">Do you ever find yourself falling into the “discount trap?</p>
                                            </div>
                                            <img src="http://gull-html-laravel.ui-lib.com/assets/images/faces/13.jpg" alt="" class="avatar-sm rounded-circle ml-3">
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="message flex-grow-1">
                                                <div class="d-flex">
                                                    <p class="mb-1 text-title text-16 flex-grow-1">Frank Powell</p>
                                                    <span class="text-small text-muted">25 min ago</span>
                                                </div>
                                                <p class="m-0">Do you ever find yourself falling into the “discount trap?</p>
                                            </div>
                                            <img src="http://gull-html-laravel.ui-lib.com/assets/images/faces/13.jpg" alt="" class="avatar-sm rounded-circle ml-3">
                                        </div>

                                    </div>

                                    <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area" >
                                        <form  class="inputForm" >
                                            <div class="form-group">
                                                <textarea class="form-control form-control-rounded"  placeholder="Type your message"
                                                    name="message" id="message" cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-grow-1"></div>
                                                <button class="btn btn-icon btn-rounded btn-primary mr-2">
                                                    <i class="i-Paper-Plane"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>   
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>    

@endsection