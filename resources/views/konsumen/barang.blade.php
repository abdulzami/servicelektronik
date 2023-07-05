@extends('layouts.master')
@push('custom-css')
    <link rel="stylesheet" href={{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Barang-Barang Anda</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen Barang</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('sb-barang')
    bg-light
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Barang Anda
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th>Nama Barang</th>
                                        <th>Nomor Seri</th>
                                        <th>Tipe</th>
                                        <th>Tanggal Barang Masuk</th>
                                        <th>Status Barang</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status Ambil</th>
                                        <th>Tanggal Pengambilan</th>
                                        <th>Harga Pengerjaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $index => $barang)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->nomor_seri }}</td>
                                            <td>{{ $barang->tipe }}</td>
                                            <td>{{ $barang->tanggal_masuk }}</td>
                                            <td>{{ $barang->status_barang }}</td>
                                            <td>
                                                @if ($barang->tanggal_pengambilan)
                                                    Sudah
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($barang->tanggal_pengambilan)
                                                    {{$barang->tanggal_pengambilan}}
                                                @else
                                                    -
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
                                            <td>
                                                @php
                                                    $i = Crypt::encryptString($barang->id_pengambilan);
                                                @endphp
                                                <a href="{{ route('barang.cetaknota', $i) }}"
                                                    class="btn btn-sm btn-outline-dark mb-3"><i
                                                        class="fa fa-file-invoice-dollar ">
                                                    </i> Cetak Nota
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th>Nama Barang</th>
                                        <th>Nomor Seri</th>
                                        <th>Tipe</th>
                                        <th>Tanggal Barang Masuk</th>
                                        <th>Status Barang</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status Ambil</th>
                                        <th>Tanggal Pengambilan</th>
                                        <th>Harga Pengerjaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">

            </div>
            <!-- /.col-md-6 -->
        </div>
    </div><!-- /.container-fluid -->
@endsection
@push('custom-script')
    <script src={{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
    <script src={{ asset('assets/plugins/select2/js/select2.full.min.js') }}></script>
    <script src={{ asset('assets/plugins/toastr/toastr.min.js') }}></script>
    <script src={{ asset('assets/sweetalert2.all.js') }}></script>
    <script>
    </script>
    <script>
        $(".swall-yeah").click(function(e) {
            let id = e.target.dataset.id;
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini ?',
                text: "Anda tidak akan bisa mengembalikan nya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete' + id).submit();
                }
            })
        })

        $(".swall-yeah2").click(function(e) {
            let id = e.target.dataset.id;
            Swal.fire({
                title: 'Apakah anda yakin ingin reset password Barang ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, reset !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#resetp' + id).submit();
                }
            })
        })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({});
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif
    @if (session('gagal'))
        <script>
            toastr.error('{{ session('gagal') }}');
        </script>
    @endif
    @if ($errors->any())
        <script>
            let errornya = [
                @foreach ($errors->all() as $error)
                    [ "{{ $error }}" ],
                @endforeach
            ];
            errornya.forEach(function(error) {
                toastr.warning(error);
            });
        </script>
    @endif

@endpush
