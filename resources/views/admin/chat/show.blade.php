@extends('layouts.master')

@section('content')
<div class="main-content">
    <div data-sidebar-container="chat" class="card chat-sidebar-container sidebar-container">
                
        <div data-sidebar-content="chat" class="chat-content-wrap sidebar-content" >
            <div class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar">
                <a data-sidebar-toggle="chat" class="link-icon d-md-none">
                    <i class="icon-regular i-Right ml-0 mr-3"></i>
                </a>
                <div class="d-flex align-items-center">
                    <p class="m-0 text-title text-16 flex-grow-1">Proyek : {{ $projeks->nama_projek }}</p>
                </div>
            </div>

            <div class="chat-content perfect-scrollbar ps ps--active-y" data-suppress-scroll-x="true">
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

            <div class="ps_rail-x" style="left: 0px; bottom: 0px;"><div class="psthumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="psrail-y" style="top: 0px; height: 396px; right: 0px;"><div class="ps_thumb-y" tabindex="0" style="top: 0px; height: 348px;"></div></div></div>

            <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
                @can('chatdetail-add')
                    <form class="inputForm" action="{{ route('chat_detail.add') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="chat_id" value="{{ $projeks['slug'] }}" class="form-control" readonly>
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
                @endcan
            </div>

        </div>
    </div>
</div>
@endsection