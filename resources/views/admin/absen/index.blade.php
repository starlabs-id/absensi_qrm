@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Absen (Karyawan)
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
                                <th>Nama Tukang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($absens as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <!-- <form method="post" id="frm-nota" action="" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" hidden class="form-control" name="id" value="{{ $tukangs['id'] }}">
                                        <input type="text" hidden class="form-control" name="user_id" value="{{ $tukangs['user_id'] }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Daftar Absen</button>
                                    </form> -->
                                    <a href="{{ route('absen.detail', ['id'=>$row->id,'user_id'=>$row->user_id]); }}" class="btn btn-primary btn-xs">Daftar Absen</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>
@endsection