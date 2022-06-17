@extends('layouts.master')

@section('content')
<div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
            <h4 class="card-title mb-3">
                    Detail Proyek
                    <span class="pull-right">
                        <button class="btn btn-warning btn-sm pull-right">
                            <a href="{{ route('projek.index') }}">Kembali</a>
                        </button>
                    </span>
                </h4>

                <div id="smartwizard" class="col-md-12">
                    <ul>
                        <li>
                            <a href="#data">Detail</a>
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
                            <h4>Detail</h4>
                            <br>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="alternative_pagination_table" class="display table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pekerjaan</th>
                                                <th>Status</th>
                                                <th>Lokasi</th>
                                                <th>Shift</th>
                                                <th>Foto 1</th>
                                                <th>Foto 2</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($detailprojeks as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ date('d/m/Y', strtotime($row['tanggal'])) }} {{ $row->jam }}</td>
                                                <td>{{ $row->nama_pekerjaan }}</td>
                                                <td>
                                                    @if($row->status == 'baik')
                                                        <span class="badge badge-success m-2">Baik</span>
                                                    @elseif($row->status == 'penggantian')
                                                        <span class="badge badge-danger m-2">Penggantian</span>
                                                    @else
                                                        <span class="badge badge-danger m-2">Perbaikan Ringan</span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->lokasi }}</td>
                                                <td>{{ $row->shift }}</td>
                                                <td>
                                                    @if($row->foto_1 != '')
                                                        <img class="d-block" width="100%" src="{{ asset('storage/projekdetail/'. $row->foto_1) }}">
                                                    @else
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($row->foto_2 != '')
                                                        <img class="d-block" width="100%" src="{{ asset('storage/projekdetail/'. $row->foto_2) }}">
                                                    @else
                                                    @endif
                                                </td>
                                                <td>{{ $row->keterangan }}</td>
                                                <td>
                                                    @can('projekdetail-list')
                                                        <a href="{{ route('projekdetail.kerusakan', $row->id) }}" class="btn btn-success btn-sm">Detail Kerusakan</a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tukang">
                            <h4>Daftar Karyawan</h4>
                            <br>
                            <div class="table-responsive">
                                <table id="" class="display table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <!-- <th>Shift</th> -->
                                            <!-- <th>Biaya Harian</th>
                                            <th>Biaya Lembur</th> -->
                                        </tr>
                                    </thead>
                                    <?php $no = 1; ?>
                                    @foreach($tukangs as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->namea }}</td>
                                        <!-- <td>{{ $row->nama_shift }}</td> -->
                                        <!-- <td>Rp. {{ number_format($row->biaya_harian, 2, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($row->biaya_lembur, 2, ',', '.') }}</td> -->
                                    </tr>
                                    @endforeach
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
                                                @if($row->foto != '')
                                                    <img src="{{ asset('storage/user/' . $row->foto) }}" alt="" class="avatar-sm rounded-circle ml-3">
                                                @else
                                                    <img src=https://ui-avatars.com/api/?name={{$row->name}}&background=4e73df&color=ffffff&size=100" alt="" class="avatar-sm rounded-circle ml-3">
                                                @endif
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