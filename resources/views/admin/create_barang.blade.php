@extends('layouts.master')
@push('custom-css')
<link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Barang </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-barang') }}">Manajemen Barang</a></li>
                    <li class="breadcrumb-item active">Tambah Barang</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('sb-barang')
    bg-light
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Barang<div class="badge badge-info"></div>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('m-barang.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputAddress">Nama Barang</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Nomor Seri</label>
                            <input type="text" class="form-control" name="nomor_seri" placeholder="Masukkan Nomor Seri">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tipe Barang</label>
                            <input type="text" class="form-control" name="tipe" placeholder="Masukkan Tipe Barang">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" placeholder="Masukkan Tanggal Masuk">
                        </div>
                        <div class="form-group">
                            <label>Pemilik Barang (Konsumen)</label>
                            <select class="form-control" name="pemilik_barang">
                            <option value="">Pilih Pemilik Barang (Nama -- No HP)</option>
                            @foreach ($konsumens as $index => $konsumen)
                            <option value="{{Crypt::encryptString($konsumen->id)}}">{{$konsumen->nama}} -- {{$konsumen->no_hp}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
<script src={{ asset('assets/plugins/toastr/toastr.min.js') }}></script>
<script>
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
        errornya.forEach(function(error){
            toastr.warning(error);
        });
    </script>
    @endif
@endpush
