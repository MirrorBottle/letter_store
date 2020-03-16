@extends('layouts.app', ['title' => __('Mails')])
@section('content')
    @include('layouts.headers.cards', ['message' => 'Surat'])
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Mails') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @include('layouts.alert')
                        </div>
                        <ul class="nav nav-pills mb-4" id="mails-tab" role="tablist">
                            @foreach ($types as $type)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->iteration == 1 ? 'active' : ''}}" id="{{$type->name}}-tab" data-toggle="pill" href="#pills-{{$type->name}}" role="tab" aria-controls="pills-{{$type->name}}" aria-selected="true">{{$type->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="tab-content" id="mails-tabContent">
                            @foreach ($datas as $data)
                            <div class="tab-pane fade {{$loop->iteration == 1 ? 'show active' : ''}}" id="pills-{{$data['type']}}" role="tabpanel" aria-labelledby="pills-{{$data['type']}}-tab">
                                <div class="table-responsive container mt-4">
                                    <table class="table align-items-center table-flush datatable w-100">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">{{ __('No.') }}</th>
                                                <th scope="col">{{ __('Reference Number') }}</th>
                                                <th scope="col">{{ __('Subject') }}</th>
                                                <th scope="col">{{ __('Doc File') }}</th>
                                                <th scope="col">{{ __('Creation Date') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['mails'] as $mail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mail->no_surat}}</td>
                                                    <td>{{ $mail->perihal}}</td>
                                                    <td>{{ $mail->doc}}</td>
                                                    <td>{{ date("F d, Y", strtotime($mail->created_at)) }}</td>
                                                    <td class="text-center">
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <a href="{{url('mails/edit', $mail->id)}}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="Ubah Surat">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" data-pdf="{{$mail->pdf}}" data-word="{{$mail->doc}}" class="btn btn-sm btn-success btn-delete btn-download" data-toggle="modal" data-target="#downloadModal" title="Unduh Surat">
                                                                    <i class="fa fa-download"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <button type="button" data-file="{{$mail->pdf}}" class="btn btn-sm btn-warning btn-delete btn-print" data-toggle="tooltip" title="Cetak Surat">
                                                                    <i class="fa fa-print"></i>
                                                                </button>
                                                            <a href="{{route('mails.destroy', $mail)}}" class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" title="Hapus Surat" onclick="confirm('{{ __("Are you sure you want to delete this mail?") }}') ? this.parentElement.submit() : ''">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('mails.modal')
@endsection
@push('css')
    <style>
        .table-responsive {
            padding-right: 30px;
        }
    div.dataTables_wrapper div.dataTables_length label {
        margin-top: 9px;
    }


    table tbody  tr {
        width: 100%;
    }
    div.dataTables_wrapper div.dataTables_paginate {
        margin-top: 1rem;
    }
    div.dataTables_wrapper div.dataTables_info {
        padding-top: 1.5em;
        font-size: .9rem;
    }
    .table th, .table td {
        white-space: normal;
        line-height: 1.2;
    }
    </style>
@endpush
@push('js')
    <script>
        $('.btn-print').on('click', function(e) {
            e.preventDefault();
            var w = window.open(`{{asset('storage/pdf')}}/${$(this).data('file')}`);
            w.print();
        })
        $('.btn-download').on('click', function(e) {
            console.log(e);
            $('#pdf-download').attr('href', `{{asset('storage/pdf')}}/${$(this).data('pdf')}`);
            $('#docx-download').attr('href', `{{asset('storage/word')}}/${$(this).data('word')}`);
        })
    </script>
@endpush
