@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Data Absen Lembur
                </h4>
                <br>
                
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">No.</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absenlemburs as $no => $absen)
                            <tr>
                                <td>{{ ++$no + ($absenlemburs->currentPage()-1) * $absenlemburs->perPage() }}</td>
                                <td>{{ $absen->nama_proyek }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('admin.absenlembur.edit', $absen->id) }}"
                                        class="btn btn-sm btn-primary">
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

            </div>
        </div>
    </div>
    <!-- end of col -->

</div>
@endsection