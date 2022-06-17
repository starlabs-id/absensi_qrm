@extends('layouts.master')

@section('content')
<div class="row">
    <!-- ICON BG -->
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <i class="i-Add-User"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Karyawan</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $total_karyawan }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <i class="i-Financial"></i>
                <div class="col-md-12">
                    <p class="text-muted mt-2 mb-0" style="width: 250px;">Pekerjaan Belum di Approve APP</p>
                    <h4 class="text-muted" style="width: 250px;">500</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <i class="i-Checkout-Basket"></i>
                <div class="col-md-12">
                    <p class="text-muted mt-2 mb-0" style="width: 250px;">Pekerjaan Belum di Approve AP1</p>
                    <h4 class="text-muted" style="width: 250px;">450</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <i class="i-Money-2"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Expense</p>
                    <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                </div>
            </div>
        </div>
    </div> -->
    

</div>
@endsection
