@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--4">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-4">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header col-lg-4 col-12 bg-transparent">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Total</h6>
                                <h2 class=" mb-0 text-primary">Surat</h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-mail-bulk fa-5x text-primary"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-primary mb-0">{{$mails}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Tersedia</h3>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-eraser fa-5x text-danger"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-danger mb-0">{{$deleted}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Penghapusan</h3>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-folder-plus fa-5x text-success"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-success mb-0">{{$added}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Penambahan</h3>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-print fa-5x text-warning"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-warning mb-0">{{$printed}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Pencetakan</h3>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-city fa-5x text-info"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-info mb-0">{{$cities}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Kota</h3>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex flex-column justify-content-center align-items-center">
                                        <h2><i class="fas fa-stream fa-5x text-default"></i></h2>
                                    <h2 class="font-weight-bold display-3 text-default mb-0">{{$mail_types}}</h2>
                                        <h3 class="mt-0 text-uppercase text-muted">Tipe surat</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-xl-12 mb-5">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header col-lg-4 col-12 bg-transparent">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Catatan</h6>
                                <h2 class=" mb-0 text-primary">Kegiatan Terakhir</h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body container">
                                @forelse ($logs as $log)
                                    <div class="card log-card mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-7 col-12 d-flex align-items-center">
                                                <h2>{{$log->message}}</h2>
                                                </div>
                                                <div class="col-md-5 col-12 d-flex align-items-center justify-content-end">
                                                    <div>
                                                    <a href="" class="btn btn-secondary log-btn" data-toggle="tooltip" data-html="true" title="{{$log->created_at}}">
                                                            <i class="fas fa-eye text-primary text-center"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h3 class="text-center font-weight-bold text-uppercase text-muted">Catatan kegiatan tidak tersedia...</h3>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
@push('css')
    <style>
        .log-card {
            border: none!important;
            box-shadow: 3px 3px 6px rgba(0,0,0,.12);
        }
        .log-card h2 {
            font-weight: 500!important;
        }
        .log-card .log-btn {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            line-height: 30px;
            text-align: center;
            background: #fff;
            box-shadow: 3px 3px 6px rgba(0,0,0,.12),
            -3px -3px 6px rgba(255,255,255,1);
        }
        .log-card .log-btn:hover {
            box-shadow: inset 2px 2px 4px rgba(0,0,0,.12),
            inset -2px -2px 4px rgba(255,255,255,1);
        }
    </style>
@endpush