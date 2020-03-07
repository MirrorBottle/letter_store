@extends('layouts.app', ['title' => __('Mail Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Mail')])
    {{-- {{asset('storage/html/Kimino Shiranai Monogatari_1583240669.html')}} --}}
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Mail Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('mails') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('mails', $mail->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">{{ __('Mail information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('no_surat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-no_surat">{{ __('Reference Number') }}</label>
                                    <input type="text" name="no_surat" id="input-no_surat" class="form-control form-control-alternative{{ $errors->has('no_surat') ? ' is-invalid' : '' }}" placeholder="{{ __('Reference Number') }}" value="{{ old('no_surat', $mail->no_surat) }}" required>
                                    @if ($errors->has('no_surat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_surat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('perihal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-perihal">{{ __('Perihal') }}</label>
                                    <input type="text" name="perihal" id="input-perihal" class="form-control form-control-alternative{{ $errors->has('perihal') ? ' is-invalid' : '' }}" placeholder="{{ __('Perihal') }}" value="{{ old('perihal', $mail->perihal)}}" required>

                                    @if ($errors->has('perihal'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('perihal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('surat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-surat">{{ __('Surat') }}</label>
                                    <textarea id="editor" name="surat" id="input-surat" class="form-control form-control-alternative{{ $errors->has('surat') ? ' is-invalid' : '' }}" placeholder="{{ __('Surat') }}">
                                    </textarea>
                                    @if ($errors->has('surat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @include('mails._js', ['file' => asset("storage/html/$mail->html")])
@endpush
