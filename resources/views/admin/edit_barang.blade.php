@extends('layouts.master')
@push('custom-css')
<link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Barang </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-barang') }}">Manajemen Barang</a></li>
                    <li class="breadcrumb-item active">Edit Barang</li>
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
                    <h3 class="card-title">Form Edit Barang<div class="badge badge-info"></div>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('m-barang.update',$id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="inputAddress">Nama Barang</label>
                            <input type="text" class="form-control" name="nama" value="{{$barang->nama}}" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Nomor Seri</label>
                            <input type="text" class="form-control" name="nomor_seri" value="{{$barang->nomor_seri}}" placeholder="Masukkan Nomor Seri">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tipe Barang</label>
                            <input type="text" class="form-control" name="tipe" value="{{$barang->tipe}}" value="" placeholder="Masukkan Tipe Barang">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" value="{{$barang->tanggal_masuk}}" placeholder="Masukkan Tanggal Masuk">
                        </div>
                        <div class="form-group">
                            <label>Pemilik Barang (Konsumen)</label>
                            <select class="form-control" name="pemilik_barang">
                            <option value="">Pilih Pemilik Barang</option>
                            @foreach ($konsumens as $index => $konsumen)
                            <option value="{{Crypt::encryptString($konsumen->id)}}" 
                                @if ($konsumen->id == $barang->id_konsumen)
                                    selected
                                @endif
                                >{{$konsumen->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{$barang->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Barang</label>
                            <select class="form-control" name="status_barang">
                            <option>Pilih Status Barang</option>
                            <option value="Belum dikerjakan"
                            @if ($barang->status_barang == "Belum dikerjakan")
                                selected
                            @endif
                            >Belum Dikerjakan</option>
                            <option value="Proses pengerjaan"
                            @if ($barang->status_barang == "Proses pengerjaan")
                                selected
                            @endif
                            >Proses Pengerjaan</option>
                            <option value="Selesai"
                            @if ($barang->status_barang == "Selesai")
                                selected
                            @endif
                            >Selesai</option>
                            <option value="Tidak bisa dikerjakan"
                            @if ($barang->status_barang == "Tidak bisa dikerjakan")
                                selected
                            @endif
                            >Tidak Bisa Dikerjakan</option>
                            </select>
                        </div>
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jika Status Barang Selesai
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputAddress">Biaya Total Kebutuhan Pengerjaan</label>
                                    <h5><span class="badge badge-warning">@currency2($kepengs)</span></h5>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Harga Pengerjaan</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="text" name="harga_pengerjaan" value="{{$barang->harga_pengerjaan}}" id="masking2" class="form-control" placeholder="Masukkan Harga Pengerjaan" aria-label="Username" aria-describedby="basic-addon1">
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Tanggal Selesai</label>
                                    <input type="date" class="form-control" value="{{$barang->tanggal_selesai}}" name="tanggal_selesai" placeholder="Masukkan Tanggal Selesai">
                                </div>
                            </div>
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
<script src={{ asset('assets/plugins/mask/jquery.mask.min.js') }}></script>
<script>
$(document).ready(function(){
    $('#masking2').mask('#.##0', {reverse: true});
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
        errornya.forEach(function(error){
            toastr.warning(error);
        });
    </script>
    @endif
@endpush
