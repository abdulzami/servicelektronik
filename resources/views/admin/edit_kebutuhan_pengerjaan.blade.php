@extends('layouts.master')
@push('custom-css')
<link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Kebutuhan Pengerjaan <span class="badge badge-primary">{{$nama_barang}}</span></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-barang') }}">Manajemen Barang</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-kebutuhanpengerjaan',$id_barang) }}">Kebutuhan Pengerjaan</a></li>
                    <li class="breadcrumb-item active">Edit Kebutuhan Pengerjaan</li>
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
                    <h3 class="card-title">Form Edit Kebutuhan Pengerjaan<div class="badge badge-info"></div>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('m-kebutuhanpengerjaan.update',$id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="inputAddress">Nama Kebutuhan</label>
                            <input type="text" value="{{$kepeng->nama_kebutuhan}}" class="form-control" name="nama_kebutuhan" placeholder="Masukkan Nama Kebutuhan">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Biaya</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" name="biaya" value="{{$kepeng->biaya}}" id="masking2" class="form-control" placeholder="Masukkan Harga Pengerjaan" aria-label="Username" aria-describedby="basic-addon1">
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
