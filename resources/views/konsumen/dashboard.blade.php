@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Selamat Datang, {{ Auth::user()->nama }}</h1>
                <p class="lead"></p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Barang yang harus anda ambil</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20px">No.</th>
                            <th>Nama Barang</th>
                            <th>Nomor Seri</th>
                            <th>Tipe</th>
                            <th>Status Barang</th>
                            <th>Tanggal Selesai</th>
                            <th>Harga Pengerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($barangs->isEmpty())
                            <td colspan="6" align="center">Tidak ada</td>
                        @else
                            <tr>
                                @foreach ($barangs as $index => $barang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->nomor_seri }}</td>
                                <td>{{ $barang->tipe }}</td>
                                <td>
                                    @if ($barang->status_barang == "Selesai")
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-dark">Tidak Bisa dikerjakan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($barang->tanggal_selesai)
                                        {{ $barang->tanggal_selesai }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($barang->harga_pengerjaan)
                                        @currency2($barang->harga_pengerjaan)
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                        @endif


                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@push('custom-script')
    {{-- <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script> --}}
@endpush
