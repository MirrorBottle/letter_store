@extends('layouts.app', ['title' => __('Logs')])
@section('content')
    @include('layouts.headers.cards', ['message' => 'Logs'])
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Logs') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('mail.create') }}" class="btn btn-sm btn-primary">{{ __('Add mail') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive container py-4">
                        <table class="table align-items-center table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('No.') }}</th>
                                    <th scope="col">{{ __('User') }}</th>
                                    <th scope="col">{{ __('Message') }}</th>
                                    <th scope="col">{{ __('Activity') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col">{{ __('Update Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $l)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $l->user_id}}</td>
                                        <td>{{ $l->message}}</td>
                                        <td>{{ $l->activity}}</td>
                                        <td>{{ date("F d, Y", strtotime($l->created_at)) }}</td>
                                        <td>{{ date("F d, Y", strtotime($l->updated_at)) }}</td>
                                        <td class="text-right">

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
    @include('mails.modal')
@endsection
