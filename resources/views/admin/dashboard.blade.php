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
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pendaptan Kotor</span>
                    <span class="info-box-number">
                        @currency2($pendapatan_kotor)
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-line"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pendapatan Bersih</span>
                    <span class="info-box-number">
                        @currency2($pendapatan_bersih)
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    
@endsection
@push('custom-script')
    {{-- <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script> --}}
@endpush
