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

                <div id="smartwizard" class="col-md-12">
                    <ul>
                        <li>
                            <a href="#data">Data</a>
                        </li>
                        <li>
                            <a href="#detail_harian">Detail Harian</a>
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
                                        <span>{{ $projeks->nama_projek }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Kode Proyek</p>
                                        <span>{{ $projeks->kode_projek }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Nomor Kontrak</p>
                                        <span>{{ $projeks->nomor_kontrak }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Kontrak</p>
                                        <span>{{ date('d/m/Y', strtotime($projeks['tanggal_kontrak'])) }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Selesai</p>
                                        <span>
                                            @if($projeks->tanggal_selesai == null)
                                                <span class="badge badge-success m-2">{{ $projeks->status }}</span>
                                            @else
                                                <span class="badge badge-danger m-2">{{ $projeks->tanggal_selesai }}</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Prestasi Fisik</p>
                                        <span>Rp. {{ number_format($projeks->total_prestasi_fisik, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Judul Kontrak</p>
                                        <span>{{ $projeks->judul_kontrak }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Nilai Kontrak</p>
                                        <span>{{ $projeks->nilai_kontrak }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Durasi Kontrak</p>
                                        <span>{{ $projeks->durasi_kontrak }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Durasi Proyek</p>
                                        <span>{{ $projeks->durasi_proyek }} Hari</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Volume Pekerjaan Sebelumnya</p>
                                        <span>{{ $projeks->total_volume_pekerjaan_sebelumnya }} ㎡</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Pekerja</p>
                                        <span>{{ $projeks->total_pekerja }} Orang</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Lokasi</p>
                                        <span>{{ $projeks->lokasi }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Pemberi Kerja</p>
                                        <span>{{ $projeks->pemberi_kerja }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">PM</p>
                                        <span>{{ $projeks->pm }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Marketing</p>
                                        <span>{{ $projeks->name }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Volume Pekerjaan Hari Ini</p>
                                        <span>{{ $projeks->total_volume_pekerjaan_hari_ini }} ㎡</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Supervisor</p>
                                        <span>{{ $projeks->supervisor }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Rencana Kerja</p>
                                        <span>{{ $projeks->rencana_kerja }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Owner</p>
                                        <span>{{ $projeks->owner }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Tanggal Mulai</p>
                                        <span>{{ date('d/m/Y', strtotime($projeks['tanggal_mulai'])) }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1">Total Prestasi Keuangan</p>
                                        <span>Rp. {{ number_format($projeks->total_prestasi_keuangan, 2, ',', '.') }}</span>
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
                                            <th>Uraian Pekerjaan</th>
                                            <th>Volume Kontrak</th>
                                            <th>Harga Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($detailprojeks as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->uraian_pekerjaan }}</td>
                                            <td>{{ $row->volume_kontrak }}</td>
                                            <td>{{ $row->harga_satuan }}</td>
                                            <td>
                                                <a href="{{ route('proyekdetail.show', $row->id) }}" class="btn btn-success btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="chat">
                            <h4>Chat Room</h4>
                            <br>
                            
                            @if($chats == null)
                                <p class="mb-1 text-danger text-16 flex-grow-1">Silahkan membuat Chat Room dahulu <a href="{{ route('chat.index') }}" class="btn btn-success btn-sm">Create</a></p>
                            @else
                            <div data-sidebar-container="chat" class="card chat-sidebar-container">
                                
                                <div data-sidebar-content="chat" class="chat-content-wrap">

                                    <div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true">
                                        @foreach($chatdetails as $row)
                                            <div class="d-flex mb-4">
                                                <div class="message flex-grow-1">
                                                    <div class="d-flex">
                                                        <p class="mb-1 text-title text-16 flex-grow-1">{{ $row->name }}</p>
                                                        <span class="text-small text-muted">{{ $row->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="m-0">{{ $row->komentar }}</p>
                                                </div>
                                                <img src="{{ asset('storage/user/' . $row->foto) }}" alt="" class="avatar-sm rounded-circle ml-3">
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area" >
                                        <form class="inputForm" action="{{ route('projek_chat.add') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="hidden" name="projek_id" value="{{ $projeks['id'] }}" class="form-control" readonly>
                                                <input type="hidden" name="chat_id" value="{{ $chats['slug'] }}" class="form-control" readonly>
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" readonly>
                                                <textarea class="form-control form-control-rounded" placeholder="Type your message" name="komentar" id="komentar" cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-grow-1"></div>
                                                @if($chats->superadmin == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->direktur_utama == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->direktur_teknik == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->admin_teknik == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->pm == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->marketing == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->gm == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->co_gm == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->supervisor == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @elseif($chats->owner == Auth::user()->id)
                                                    <button class="btn btn-icon btn-rounded btn-success mr-2"><i class="i-Paper-Plane"></i></button>
                                                @else
                                                @endif
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>    

@endsection