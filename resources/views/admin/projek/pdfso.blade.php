<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Program Toilet Karyawan | PT Qinar Raya Mandiri</title>

        <link rel="icon" href="https://qinarraya.com/wp-content/uploads/2022/04/Logo-Q-1.png">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <!-- <link rel="stylesheet" href="{{ public_path('packages/styles/vendor/pdf/bootstrap.css') }}" media="all"> -->

        <style type="text/css">
            @font-face {
                font-family: 'Lato-Italic';
                src: url('Lato-BoldItalic.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: 'Lobster';
                src: url('Lobster-Regular.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: 'Vibes';
                src: url("https://fonts.googleapis.com/css?family=Great+Vibes") format('truetype');
                font-weight: normal;
                font-style: normal;
            }
                    
            .pull-right {
                float: right !important;
            }

            table tr td,
            table tr th{
                font-size: 10pt;
            }

            p{
                font-size: 10pt;
            }
        </style>
    </head>

    <body>
        <div class="row">
            <!-- <div class="col-md-3">
                <img src="{{ public_path('images/logo.png') }}">
            </div> -->
            <div class="col-md-12">
                <br><br>
                <h6><center>PEKERJAAN PERAWATAN DAN PERBAIKAN TOILET DI TERMINAL INTERNASIONAL DAN TERMINAL DOMESTIK BANDAR UDARA INTERNASIONAL I GUSTI NGURAH RAI- BALI </center></h6>
                <!-- <h5><center><b>POLITEKNIK KESEHATAN KARTINI BALI</b></center></h5>
                <span style="font-size: 11px;">
                <center>Jln. Piranha No 2 Pegok Sesetan Denpasar. Telp (0361) 720471<br>
                E-mail: info@politeknikkesehatankartinibali.ac.id<br>
                Web: www.politeknikkesehatankartinibali.ac.id</center>
                </span>
                <hr style="border-top: 3px double #8c8b8b;">
                <h5><center><b>Kartu Hasil Studi (KHS)</b></center></h5> -->
                <br><br>
                <br><br>
            </div>
        </div>

        <div style="margin-top: -70px;"><span></span></div>
        <br><br>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Jenis Kerusakan</th>
                        <th>Harga</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Foto</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($jenis_kerusakan as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama_pekerjaan }}</td>
                        <td>Rp. {{ number_format($row->harga, 2, ',', '.') }}</td>
                        <td>{{ $row->volume }}</td>
                        <td>{{ $row->satuan }}</td>
                        <td><img class="d-block" width="50%" src="{{ asset('storage/foto_kerusakan/'. $row->foto) }}"></td>
                        <td>Rp. {{ number_format($row->total_harga, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th style="text-align:right;">Total Biaya</th>
                        <th>Rp. {{ number_format($total_harga, 2, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>

            <p>
                Disetujui PM : {{ $approval->approval_pm_id }} pada {{ date('d-m-Y H:i:s', strtotime($approval['tanggal_approval_pm'])) }}<br> 
                Disetujui APP : {{ $approval->approval_app_id }} pada {{ date('d-m-Y H:i:s', strtotime($approval['tanggal_approval_app'])) }}<br> 
                Disetujui AP1 : {{ $approval->approval_ap1_id }} pada {{ date('d-m-Y H:i:s', strtotime($approval['tanggal_approval_ap1'])) }}<br> 
            </p>
        </div>
        <br>
    </body>
</html>