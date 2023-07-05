@extends('layouts.master')
@push('custom-css')
<link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
@endpush
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Konsumen </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('m-konsumen') }}">Manajemen Konsumen</a></li>
                    <li class="breadcrumb-item active">Edit Konsumen</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('sb-konsumen')
    bg-light
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Konsumen<div class="badge badge-info"></div>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('m-konsumen.update',$id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="inputAddress">Nama Konsumen</label>
                            <input type="text" class="form-control" name="nama" value="{{$konsumen->nama}}" placeholder="Masukkan Nama Konsumen">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jk">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L"
                            @if ($konsumen->jk == 'L')
                                selected
                            @endif
                            >L</option>
                            <option value="P"
                            @if ($konsumen->jk == 'P')
                                selected
                            @endif
                            >P</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Alamat</label>
                            <input type="text" class="form-control" value="{{$konsumen->alamat}}" name="alamat" placeholder="Masukkan Alamat">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">No HP</label>
                            <input type="number" class="form-control" value="{{$konsumen->no_hp}}" name="no_hp" placeholder="Masukkan No HP">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">No WA</label>
                            <input type="number" class="form-control" value="{{$konsumen->no_wa}}" name="no_wa" placeholder="Masukkan No WA">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Username</label>
                            <input type="text" class="form-control" name="username" value="{{$konsumen->username}}" placeholder="Masukkan Username">
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
