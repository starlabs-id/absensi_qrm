@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Absen

                    <span class="pull-right">
                        <!-- <a class="btn btn-success btn-sm" href="#modal-import" data-toggle="modal">Import</a>
                        <a class="btn btn-light btn-sm" href="{{ route('user_export') }}" target="_blank" style="margin-right: 5px;">Export</a> -->
                        <a href="{{ route('admin.absen.create') }}" class="btn btn-primary btn-sm pull-right">Tambah</a>
                    </span>
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">No.</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam Datang</th>
                                <th scope="col">Jam Pulang</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Validasi</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absens as $no => $absen)
                            <tr>
                                <td>{{ ++$no + ($absens->currentPage()-1) * $absens->perPage() }}</td>
                                <td>{{ $absen->hari }}, {{ $absen->tanggal }}</td>
                                <td>{{ $absen->jam_datang }}</td>
                                <td>{{ $absen->jam_pulang }}</td>
                                <td>{{ $absen->status }}</td>
                                <td>{{ $absen->keterangan }}</td>
                                <td>{{ $absen->validasi }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('admin.absen.edit', $absen->id) }}"
                                        class="btn btn-sm btn-primary">
                                    </a>

                                    <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                        id="{{ $absen->id }}">
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
                        {{ $absens->links("vendor.pagination.bootstrap-4") }}
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
                    url: "{{ route("admin.absen.index") }}/" + id,
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