@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Absen
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Proyek</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($absens as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_projek }}</td>
                                <td>
                                    <a href="{{ route('absensi.detail', ['id'=>$row->id,'user_id'=>$row->user_id]); }}" class="btn btn-primary btn-xs">Daftar Absen</a>
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