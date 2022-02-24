@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Chat

                    <span class="pull-right">
                        @can('chat-add')
                            <a class="btn btn-primary btn-sm pull-right" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapse-tambah">Tambah</a>
                        @endcan
                    </span>
                </h4>
                <br>
                
                <div class="collapse" id="collapse-tambah">
                    <div class="well">
                        <form method="post" id="frm-tambah" action="{{ route('chat.add') }}" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        {{ csrf_field() }}

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="picker1">Pilih Projek</label>
                                    <select name="projek_id" class="form-control">
                                        @foreach($projeks as $row)
                                            <option value="{{ $row->id }}"> {{ $row->nama_projek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Superadmin</label>
                                    <select name="superadmin" id="" class="form-control">
                                        @foreach($superadmin as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Direktur Utama</label>
                                    <select name="direktur_utama" id="" class="form-control">
                                        @foreach($direktur_utama as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Direktur Teknik</label>
                                    <select name="direktur_teknik" id="" class="form-control">
                                        @foreach($direktur_teknik as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Admin Teknik</label>
                                    <select name="admin_teknik" id="" class="form-control">
                                        @foreach($admin_teknik as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Owner</label>
                                    <select name="owner" id="" class="form-control">
                                        @foreach($owner as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="picker1">Pilih PM</label>
                                    <select name="pm" id="" class="form-control">
                                        @foreach($pm as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih PM</label>
                                    <select name="marketing" id="" class="form-control">
                                        @foreach($marketing as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih GM</label>
                                    <select name="gm" id="" class="form-control">
                                        @foreach($gm as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Co GM</label>
                                    <select name="co_gm" id="" class="form-control">
                                        @foreach($co_gm as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Pilih Supervisor</label>
                                    <select name="supervisor" id="" class="form-control">
                                        @foreach($supervisor as $row)
                                            <option value="{{ $row->id }}"> {{ $row->namea }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-flat btn-success btn-block">Simpan</button>
                            </div>

                            <br><br>  
                        
                        </form>
                    </div>
                </div>
                <br>
                
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Proyek</th>
                            <th>Peserta</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($chats as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_projek }}</td>
                                    <td>
                                        @if($row->superadmin == '')
                                        @else
                                            {{ $row->superadmin }} 
                                        @endif

                                        @if($row->direktur_utama == '')
                                        @else
                                            , {{ $row->direktur_utama }} 
                                        @endif

                                        @if($row->direktur_teknik == '')
                                        @else
                                            , {{ $row->direktur_teknik }} 
                                        @endif

                                        @if($row->admin_teknik == '')
                                        @else
                                            , {{ $row->admin_teknik }} 
                                        @endif

                                        @if($row->marketing == '')
                                        @else
                                            , {{ $row->marketing }}
                                        @endif

                                        @if($row->gm == '')
                                        @else
                                            , {{ $row->gm }}
                                        @endif

                                        @if($row->co_gm == '')
                                        @else
                                            , {{ $row->co_gm }} 
                                        @endif

                                        @if($row->pm == '')
                                        @else
                                            , {{ $row->pm }} 
                                        @endif

                                        @if($row->supervisor == '')
                                        @else
                                            , {{ $row->supervisor }} 
                                        @endif

                                        @if($row->owner == '')
                                        @else
                                            , {{ $row->owner }} 
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $row->id }}"
                                            data-projek_id="{{ $row->projek_id }}"
                                            data-superadmin="{{ $row->superadmin }}"
                                            data-direktur_utama="{{ $row->direktur_utama }}"
                                            data-direktur_teknik="{{ $row->direktur_teknik }}"
                                            data-admin_teknik="{{ $row->admin_teknik }}"
                                            data-gm="{{ $row->gm }}"
                                            data-co_gm="{{ $row->co_gm }}"
                                            data-pm="{{ $row->pm }}"
                                            data-supervisor="{{ $row->supervisor }}"
                                            data-marketing="{{ $row->marketing }}"
                                            data-owner="{{ $row->owner }}">Edit
                                        </a> -->
                                        @can('chat-add')
                                            <a href="{{ route('chat.show', $row->slug) }}" class="btn btn-success btn-sm">Detail</a>
                                        @endcan
                                        @can('chat-update')
                                            <a href="{{ route('chat.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        @endcan
                                        @can('chat-destroy')
                                            <a href="#!" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $row->id }}">Hapus</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                {{-- Modal Edit --}}
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('chat.update') }}" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Projek</label>
                                        <select name="projek_id" id="projek_id" class="form-control" style="width: 100% !important">
                                            <option disabled="" selected="">--Pilih Projek--</option>
                                            @foreach($projeks as $a)
                                                <option value="{{ $a->id }}">{{ $a->nama_projek }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Marketing</label>
                                        <select name="marketing" id="marketing" class="form-control" style="width: 100% !important">
                                            <option disabled="" selected="">--Pilih Marketing--</option>
                                            @foreach($marketing as $a)
                                                <option value="{{ $a->id }}">{{ $a->namea }}</option>
                                            @endforeach
                                        </select>
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
      $('#datatable').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var projek_id = $(this).data('projek_id');
        var superadmin = $(this).data('superadmin');
        var direktur_utama = $(this).data('direktur_utama');
        var direktur_teknik = $(this).data('direktur_teknik');
        var admin_teknik = $(this).data('admin_teknik');
        var gm = $(this).data('gm');
        var co_gm = $(this).data('co_gm');
        var pm = $(this).data('pm');
        var supervisor = $(this).data('supervisor');
        var marketing = $(this).data('marketing');
        var owner = $(this).data('owner');
        
        $('#id').val(id);
        $('#projek_id').val(projek_id);
        $('#superadmin').val(superadmin);
        $('#direktur_utama').val(direktur_utama);
        $('#direktur_teknik').val(direktur_teknik);
        $('#admin_teknik').val(admin_teknik);
        $('#gm').val(gm);
        $('#co_gm').val(co_gm);
        $('#pm').val(pm);
        $('#supervisor').val(supervisor);
        $('#marketing').val(marketing);
        $('#owner').val(owner);
      });

      $('#frm-edit').on('submit', function(e) {

      });
      
      $('#frm-tambah').on('submit', function(e) {

      });

      $('#datatable').on('click','.btn-hapus', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.confirm({
            icon: 'i-Information',
            title: 'Alert !',
            content: 'Apakah anda ingin menghapus data ini ?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: function () {
                    $.get("{{ route('chat.destroy') }}", {id:id}, function(data) {
                        toastr.success('Data berhasil dihapus');
                        location.reload();
                    });
                },
                cancel: function () {
                    $.alert('Batal!');
                },
            }
        });
      });

    });
</script>
@endsection