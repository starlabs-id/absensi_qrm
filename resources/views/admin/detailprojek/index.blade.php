@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Detail Proyek

                      <span class="pull-right">
                          <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                          <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                          <a href="{{ route('admin.detailprojek.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                      </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">No.</th>
                                <th scope="col">Nama Projek</th>
                                <th scope="col">Uraian Pekerjaan</th>
                                <th scope="col">Volume Kontrak</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detailprojeks as $no => $detailprojek)
                            <tr>
                                <td>{{ ++$no + ($detailprojeks->currentPage()-1) * $detailprojeks->perPage() }}</td>
                                <td>{{ $detailprojek->nama_projek }}</td>
                                <td>{{ $detailprojek->uraian_pekerjaan }}</td>
                                <td>{{ $detailprojek->volume_kontrak }}</td>
                                <td>{{ $detailprojek->harga_satuan }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('admin.detailprojek.edit', $detailprojek->id) }}"
                                        class="btn btn-sm btn-primary">
                                    </a>

                                    <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                        id="{{ $detailprojek->id }}">
                                    </button>
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
                        {{ $detailprojeks->links("vendor.pagination.bootstrap-4") }}
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
                    url: "{{ route("admin.detailprojek.index") }}/" + id,
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