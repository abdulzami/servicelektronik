@extends('layouts.master')
@push('custom-css')
<link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pengambilan Barang <span class="badge badge-primary">{{$nama_barang}}</span></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-barang') }}">Manajemen Barang</a></li>
                    <li class="breadcrumb-item active">Pengambilan Barang</li>
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
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputAddress">Harga Pengerjaan</label>
                        <h5><span class="badge badge-warning">@currency2($harga_pengerjaan)</span></h5>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Biaya Total Kebutuhan Pengerjaan</label>
                        <h5><span class="badge badge-warning">@currency2($kepengs)</span></h5>
                    </div>
                    <hr>
                    
                        @if ($harga_pengerjaan > $kepengs)
                        <h5><span class="badge badge-success">Untung @currency2($harga_pengerjaan - $kepengs)</h5>
                        @else
                        <h5><span class="badge badge-danger">Rugi @currency2($kepengs - $harga_pengerjaan)</h5>
                        
                        @endif
                    
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Pengambilan Barang<div class="badge badge-info"></div>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('m-pengambilanbarang.store',$id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputAddress">Tanggal Pengambilan</label>
                            <input type="date" class="form-control" name="tanggal_pengambilan" placeholder="Masukkan Nama Kebutuhan">
                        </div>
                        <hr>
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
