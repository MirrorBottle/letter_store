@extends('layouts.app', ['title' => __('Mails')])
@section('content')
    @include('layouts.headers.cards')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Mails') }}</h3>
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
                                    <th scope="col">{{ __('Reference Number') }}</th>
                                    <th scope="col">{{ __('Subject') }}</th>
                                    <th scope="col">{{ __('Docx File') }}</th>
                                    <th scope="col">{{ __('PDF File') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col">{{ __('Update Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mails as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->no_surat}}</td>
                                        <td>{{ $m->perihal}}</td>
                                        <td>{{ $m->doc}}</td>
                                        <td>{{ $m->pdf}}</td>
                                        <td>{{ date("F d, Y", strtotime($m->created_at)) }}</td>
                                        <td>{{ date("F d, Y", strtotime($m->updated_at)) }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('mail.destroy', $m->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="dropdown-item" {{$m->user_id != auth()->id() ? 'disabled' : ''}} onclick="confirm('{{ __("Are you sure you want to delete this mail?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="ni ni-fat-delete text-danger"></i>
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                            <i class="ni ni-books text-warning"></i>
                                                            {{ __('Edit') }}
                                                        </a>
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#downloadModal" {{$m->user_id != auth()->id() ? 'disabled' : ''}}>
                                                            <i class="ni ni-cloud-download-95 text-success"></i>
                                                            {{ __('Download') }}
                                                        </button>
                                                    </div>
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
