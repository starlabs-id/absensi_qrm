@extends('layouts.master')

@section('content')
<div class="row">
        <!-- ICON BG -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Add-User"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">New Leads</p>
                        <p class="text-primary text-24 line-height-1 mb-2">205</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Financial"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Sales</p>
                        <p class="text-primary text-24 line-height-1 mb-2">$4021</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Checkout-Basket"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Orders</p>
                        <p class="text-primary text-24 line-height-1 mb-2">80</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Money-2"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Expense</p>
                        <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="card o-hidden mb-4">
                        <div class="card-header d-flex align-items-center border-0">
                            <h3 class="w-50 float-left card-title m-0">New Users</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nav-icon i-Gear-2"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="#">Add new user</a>
                                    <a class="dropdown-item" href="#">View All users</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="table-responsive">
                                <table id="user_table" class="table  text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Smith Doe</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">

                                            </td>

                                            <td>Smith@gmail.com</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jhon Doe</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">

                                            </td>

                                            <td>Jhon@gmail.com</td>
                                            <td><span class="badge badge-info">Pending</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Alex</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">

                                            </td>

                                            <td>Otto@gmail.com</td>
                                            <td><span class="badge badge-warning">Not Active</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Mathew Doe</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">

                                            </td>

                                            <td>Mathew@gmail.com</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>


        <div class="col-lg-6 col-md-12">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Top Selling Products</div>
                    <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                        <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-4.jpg" alt="">
                        <div class="flex-grow-1">
                            <h5 class=""><a href="">Wireless Headphone E23</a></h5>
                            <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-rounded btn-sm">View details</button>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                        <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-2.jpg" alt="">
                        <div class="flex-grow-1">
                            <h5 class=""><a href="">Wireless Headphone Y902</a></h5>
                            <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <p class="text-small text-danger m-0">$550 <del class="text-muted">$600</del></p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                        <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-3.jpg" alt="">
                        <div class="flex-grow-1">
                            <h5 class=""><a href="">Wireless Headphone E09</a></h5>
                            <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <p class="text-small text-danger m-0">$250 <del class="text-muted">$300</del></p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                        <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-4.jpg" alt="">
                        <div class="flex-grow-1">
                            <h5 class=""><a href="">Wireless Headphone X89</a></h5>
                            <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</div>
@endsection
