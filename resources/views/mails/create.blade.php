@extends('layouts.app', ['title' => __('Mail Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Mail')])

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
                                <a href="{{ route('mail.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('mail.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Mail information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('no_surat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-renumber">{{ __('Reference Number') }}</label>
                                    <input type="text" name="renumber" id="input-renumber" class="form-control form-control-alternative{{ $errors->has('no_surat') ? ' is-invalid' : '' }}" placeholder="{{ __('Reference Number') }}" value="{{ old('no_surat') }}" required autofocus>

                                    @if ($errors->has('no_surat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_surat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('perihal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                    <input type="text" name="subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('perihal') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{ old('perihal') }}" required>

                                    @if ($errors->has('perihal'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('perihal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('docx') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-docx">{{ __('File (.docx)') }}</label>
                                    <input type="text" name="docx" id="input-docx" class="form-control form-control-alternative{{ $errors->has('docx') ? ' is-invalid' : '' }}" placeholder="{{ __('File (.docx)') }}" value="{{ old('docx') }}" required>

                                    @if ($errors->has('docx'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('docx') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('pdf') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-pdf">{{ __('File (.pdf)') }}</label>
                                    <input type="text" name="pdf" id="input-pdf" class="form-control form-control-alternative{{ $errors->has('pdf') ? ' is-invalid' : '' }}" placeholder="{{ __('File (.pdf') }}" value="{{ old('pdf') }}" required>

                                    @if ($errors->has('pdf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pdf') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('html') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-html">{{ __('File (.html)') }}</label>
                                    <input type="text" name="html" id="input-html" class="form-control form-control-alternative{{ $errors->has('html') ? ' is-invalid' : '' }}" placeholder="{{ __('File (.html') }}" value="{{ old('html') }}" required>

                                    @if ($errors->has('html'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('html') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('user') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-user">{{ __('') }}</label>
                                    <input type="hidden" name="user" id="input-user" class="form-control form-control-alternative{{ $errors->has('user') ? ' is-invalid' : '' }}" placeholder="{{ __('User') }}" value="{{ old('user') }}" required>
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

        @include('layouts.footers.auth')
    </div>
@endsection
