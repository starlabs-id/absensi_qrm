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
                    <p class="m-0 text-title text-16 flex-grow-1">Nama Proyek</p>
                </div>
            </div>

            <div class="chat-content perfect-scrollbar ps ps--active-y" data-suppress-scroll-x="true">
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

            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 396px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 348px;"></div></div></div>

            <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
                <form class="inputForm">
                    <div class="form-group">
                        <textarea class="form-control form-control-rounded" placeholder="Type your message" name="message" id="message" cols="30" rows="3"></textarea>
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
@endsection