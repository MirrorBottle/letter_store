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
                                <a href="{{ route('mail.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('mail.update', $mail->id) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">{{ __('Mail information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('no_surat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-renumber">{{ __('Reference Number') }}</label>
                                    <input type="text" name="renumber" id="input-renumber" class="form-control form-control-alternative{{ $errors->has('no_surat') ? ' is-invalid' : '' }}" placeholder="{{ __('Reference Number') }}" value="{{ old('no_surat', $mail->no_surat) }}" required>

                                    @if ($errors->has('no_surat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_surat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('perihal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('perihal') }}</label>
                                    <input type="text" name="subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Perihal') }}" value="{{ old('perihal', $mail->perihal)}}" required>

                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('perihal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('perihal') }}</label>
                                    <textarea id="editor" name="subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Perihal') }}" value="{{ old('perihal', $mail->perihal)}}">
                                        {!!asset('storage/html/Kimino Shiranai Monogatari_1583240669.html')!!}
                                    </textarea>

                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
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

        @include('layouts.footers.auth')
    </div>
@endsection
