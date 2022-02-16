@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Project

                    <span class="pull-right">
                        <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                        <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                        <a href="{{ route('admin.projek.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                    </span>
                </h4>
                <br>
                <form action="{{ route('admin.projek.index') }}" method="GET">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <!-- <div class="input-group-prepend">
                                <a href="{{ route('admin.projek.create') }}" class="btn btn-primary btn-sm"
                                    style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                            </div> -->
                            <input type="text" class="form-control" name="q" placeholder="cari berdasarkan nama proyek">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">No.</th>
                                <th scope="col">Nama Projek</th>
                                <th scope="col">Pemberi Kerja</th>
                                <th scope="col">Rencana Kerja</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projeks as $no => $projek)
                            <tr>
                                <td>{{ ++$no + ($projeks->currentPage()-1) * $projeks->perPage() }}</td>
                                <td>{{ $projek->nama_projek }}</td>
                                <td>{{ $projek->pemberi_kerja }}</td>
                                <td>{{ $projek->rencana_kerja }}</td>
                                <td>
                                    <a href="{{ route('admin.projek.show', $projek->id) }}" class="btn btn-success btn-sm">Detail</a>
                                    <a href="{{ route('admin.projek.edit', $projek->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $projek->id }}">Hapus</button>
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Belum Tersedia!
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                    <div style="text-align: center">
                        {{ $projeks->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>

<script>
    //ajax delete
    function Delete(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN ?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {

                //ajax delete
                jQuery.ajax({
                    url: "{{ route("admin.projek.index") }}/" + id,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            swal({
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                icon: 'error',
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });

            } else {
                return true;
            }
        })
    }
</script>
@endsection