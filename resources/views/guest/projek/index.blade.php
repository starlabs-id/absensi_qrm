@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Proyek

                    <span class="pull-right">
                        <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                        <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                        @can('projek-add')
                            <a href="{{ route('projek.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                        @endcan
                    </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Uraian</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aproval PM</th>
                                <th>Aproval APP</th>
                                <th>Aproval AP1</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($projeks as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->uraian_pekerjaan }}</td>
                                <td>{{ date('d-m-Y', strtotime($row['tanggal'])) }}</td>
                                <td>
                                    @if($row->status_pekerjaan == 'belum')
                                        <span class="badge badge-warning m-2">Menunggu Approval</span>
                                    @elseif($row->status_pekerjaan == 'Diterima')
                                        <span class="badge badge-success m-2">Diterima</span>
                                    @elseif($row->status_pekerjaan == 'Reject')
                                        <span class="badge badge-danger m-2">Reject</span>
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($row->approval_pm == 'Belum')
                                        <span class="badge badge-warning m-2">Menunggu Approval</span>
                                        @can('approval-pm')
                                            <a href="{{ route('projek.approval_pm', $row->id) }}" class="btn btn-info btn-sm" onclick="return confirm('Apakah anda ingin approve data ini ?')">Approval</a>
                                        @endcan
                                    @elseif($row->approval_pm == 'Diterima')
                                        <span class="badge badge-success m-2">Diterima</span> {{ $row->approval_pm_id }} <br> Tanggal : {{ date('d-m-Y - H:i:s', strtotime($row['tanggal_approval_pm'])) }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($row->approval_app == 'Belum')
                                        <span class="badge badge-warning m-2">Menunggu Approval</span>
                                        @can('approval-app')
                                            @if($row->approval_pm == 'Diterima')
                                                <a href="#modal-approval-app" data-toggle="modal" class="btn btn-info btn-sm btn-approval-app"
                                                data-id="{{ $row->id }}">Approval</a>
                                            @else
                                            @endif
                                        @endcan
                                    @elseif($row->approval_app == 'Diterima')
                                        <span class="badge badge-success m-2">Diterima</span> {{ $row->approval_app_id }} <br> Tanggal : {{ date('d-m-Y - H:i:s', strtotime($row['tanggal_approval_app'])) }}<br>
                                        Pesan : {{ $row->komen_app }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($row->approval_ap1 == 'Belum')
                                        <span class="badge badge-warning m-2">Menunggu Approval</span>
                                        @can('approval-ap1')
                                            @if($row->approval_app == 'Diterima')
                                                <a href="#modal-approval-ap1" data-toggle="modal" class="btn btn-info btn-sm btn-approval-ap1"
                                                data-id="{{ $row->id }}">Approval</a>
                                            @else
                                            @endif
                                        @endcan
                                    @elseif($row->approval_app == 'Diterima')
                                        <span class="badge badge-success m-2">Diterima</span> {{ $row->approval_ap1_id }} <br> Tanggal : {{ date('d-m-Y - H:i:s', strtotime($row['tanggal_approval_ap1'])) }}<br>
                                        Pesan : {{ $row->komen_ap1 }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @can('guest-proyek-list')
                                        <a href="{{ route('proyek.show', $row->id) }}" class="btn btn-success btn-sm">Detail</a>
                                    @endcan
                                    @if($row->approval_ap1 == 'Belum')
                                    @elseif($row->approval_app == 'Diterima')
                                        <a href="{{ route('pdf.so', $row->id) }}" class="btn btn-danger btn-sm" target="_blank">SO PDF</a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                {{-- Approval APP Edit --}}
                <div class="modal fade" id="modal-approval-app">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Approval APP</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('proyek.approval_app') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="approval_app">Approval</label>
                                        <select name="approval_app" class="form-control">
                                            <option value="Diterima">Diterima</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="komen_app">Komentar</label>
                                        <textarea class="form-control" id="komen_appx" name="komen_app"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Approval AP1 Edit --}}
                <div class="modal fade" id="modal-approval-ap1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Approval AP1</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('proyek.approval_ap1') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="idx" class="form-control" placeholder="ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="approval_app">Approval</label>
                                        <select name="approval_ap1" class="form-control">
                                            <option value="Diterima">Diterima</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="komen_ap1">Komentar</label>
                                        <textarea class="form-control" id="komen_ap1x" name="komen_ap1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>
@endsection

@section('customJs')
<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').on('click', '.btn-approval-app', function() {
        var id = $(this).data('id');
        
        $('#id').val(id);
      });

      $('#frm-edit').on('submit', function(e) {

      });

    });

    $(document).ready(function() {
      $('#datatable').on('click', '.btn-approval-ap1', function() {
        var id = $(this).data('id');
        
        $('#idx').val(id);
      });

      $('#frm-edit').on('submit', function(e) {

      });

    });
</script>
@endsection