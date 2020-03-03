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
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label class="form-control-label" for="input-subject">{{ __('File Docx') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white" id="basic-addon1">
                                                    <i class="fas fa-file-word"></i>
                                                </span>
                                            </div>
                                            <input type="file" name="docx" class="form-control bg-primary text-white file-input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        @if ($errors->has('docx'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('docx') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="form-control-label" for="input-subject">{{ __('File PDF') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white" id="basic-addon1">
                                                    <i class="fas fa-file-pdf"></i>
                                                </span>
                                            </div>
                                            <input type="file" name="pdf" class="form-control bg-danger text-white file-input" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        @if ($errors->has('pdf'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pdf') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
@push('css')
    <style>
        .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
        }

        .upload-btn-wrapper .btn {
            color: #fff;
            background-color: white;
            padding: 8px 20px;
            border-radius: 10px;
            font-size: 20px;
            font-weight: bold;
        }
        .upload-btn-wrapper .btn.btn-danger {
            background: #F5365C;
        }
        .upload-btn-wrapper .btn.btn-primary {
            background: #5E72E4;
        }
        .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        }
    </style>
@endpush
@push('js')
    <script>
        function disabled() {
            console.log($(this));
        }
    </script>
@endpush
