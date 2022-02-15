@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Detail Absen Lembur

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
                            @forelse($absenlemburs as $no => $absen)
                            <tr>
                                <td>{{ ++$no + ($absenlemburs->currentPage()-1) * $absenlemburs->perPage() }}</td>
                                <td>{{ $absen->hari }}, {{ $absen->tanggal }}</td>
                                <td>{{ $absen->jam_datang }}</td>
                                <td>{{ $absen->jam_pulang }}</td>
                                <td>{{ $absen->status }}</td>
                                <td>{{ $absen->keterangan }}</td>
                                <td>{{ $absen->validasi }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('admin.absenlembur.edit', $absen->id) }}" class="btn btn-sm btn-danger">Absen Pulang</a>
                                    <a href="#modal-edit" data-toggle="modal" class="btn btn-success btn-sm btn-edit"
                                        data-id="">Validasi
                                    </a>
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
                        {{ $absenlemburs->links("vendor.pagination.bootstrap-4") }}
                    </div>
                </div>

                

                {{-- Modal Validasi --}}
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Validasi Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="frm-edit" class="row needs-validation" novalidate>
                                {{ csrf_field() }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group" hidden>
                                        <label>ID</label>
                                        <input type="text" name="id" id="idx" class="form-control" placeholder="ID" required>
                                        <input type="hidden" readonly class="form-control" id="validasi_by" name="validasi_by" value="{{ Auth::user()->id }}">
                                        <input type="text" readonly class="form-control" id="projek_id" name="projek_id" value="">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Status</label>
                                        <select class="form-control">
                                            <option>Hadir</option>
                                            <option>Sakit</option>
                                            <option>Alpa</option>
                                            <option>Ijin</option>
                                            <option>Lembur</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
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
                    url: "{{ route("admin.absenlembur.index") }}/" + id,
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