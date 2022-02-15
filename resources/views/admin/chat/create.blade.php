@extends('layouts.master')

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-title mb-3">Create Chat Room</div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Proyek</label>
                    <select class="form-control">
                        <option>Proyek 1</option>
                        <option>Proyek 2</option>
                        <option>Proyek 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Direktur Utama</label>
                    <select class="form-control">
                        <option>Dirut 1</option>
                        <option>Dirut 2</option>
                        <option>Dirut 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Super Admin</label>
                    <select class="form-control">
                        <option>Super Admin 1</option>
                        <option>Super Admin 2</option>
                        <option>Super Admin 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Owner</label>
                    <select class="form-control">
                        <option>Owner 1</option>
                        <option>Owner 2</option>
                        <option>Owner 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Direktur Teknik</label>
                    <select class="form-control">
                        <option>Direktur Teknik 1</option>
                        <option>Direktur Teknik 2</option>
                        <option>Direktur Teknik 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Admin Teknik</label>
                    <select class="form-control">
                        <option>Admin Teknik 1</option>
                        <option>Admin Teknik 2</option>
                        <option>Admin Teknik 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Project Manager</label>
                    <select class="form-control">
                        <option>Project Manager 1</option>
                        <option>Project Manager 2</option>
                        <option>Project Manager 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Marketing</label>
                    <select class="form-control">
                        <option>Marketing 1</option>
                        <option>Marketing 2</option>
                        <option>Marketing 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">General Manager</label>
                    <select class="form-control">
                        <option>General Manager 1</option>
                        <option>General Manager 2</option>
                        <option>General Manager 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">CO - General Manager</label>
                    <select class="form-control">
                        <option>CO - General Manager 1</option>
                        <option>CO - General Manager 2</option>
                        <option>CO - General Manager 3</option>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">Supervisor</label>
                    <select class="form-control">
                        <option>Supervisor 1</option>
                        <option>Supervisor 2</option>
                        <option>Supervisor 3</option>
                    </select>
                </div>

                <div class="col-md-6">
                        <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection