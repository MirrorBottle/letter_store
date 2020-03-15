@extends('layouts.app', ['title' => __('Cities')])
@section('content')
    @include('layouts.headers.cards', ['message' => 'Cities'])
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Cities') }}</h3>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCity">
                                    <i class="fas fa-plus"></i>&nbsp;Add New City
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @include('layouts.alert')
                        </div>
                        <div class="col-12">
                            <form action="" method="POST" id="edit-form">
                                @csrf
                                @method('PUT')
                                <div class="input-group mb-3">
                                    <input type="text" id="edit-name" disabled name="name" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" disabled type="submit" id="edit-submit">
                                            <i class="fas fa-edit"></i>&nbsp;Edit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive container mt-4">
                            <table class="table align-items-center table-flush datatable w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('No.') }}</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col" class="text-center">{{ __('Mails Total') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $city->name}}</td>
                                            <td class="text-center">{{ $city->total_mails.' Mails'}}</td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" data-name="{{$city->name}}" data-id="{{$city->id}}" class="btn btn-sm btn-success mr-1 edit-city-btn" data-toggle="tooltip" title="Edit City">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-id="{{$city->id}}" class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" title="Delete City">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- hidden form delete --}}
    <form action="" id="form-delete" data-url="{{ url('city') }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
    @include('city.modal')
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
        $(function() {
            $('.edit-city-btn').on('click', function() {
                $('#edit-name').removeAttr('disabled');
                $('#edit-name').val($(this).data('name'));
                $('#edit-submit').removeAttr('disabled');
                $('#edit-form').attr('action', `city/${$(this).data('id')}`)
            })
            $('.btn-delete').on('click', function(e) {
                const message = "Yakin ingin menghapus data gedung?"
                const confirmAlert = confirm(message);
                if (confirmAlert == true) {
                    const id = $(this).data('id');
                    const $form = $('#form-delete');
                    $form.attr('action', $form.attr('data-url') +'/'+ id);
                    $form.submit();
                }
            })
        })
    </script>
@endpush
