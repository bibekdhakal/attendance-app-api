@extends('layouts.login_layout')

@section('content')

<main>
    <div id="primary" class="p-t-b-100">
        <div>
            <div class="row">
                <div class="col-lg-4 mx-md-auto">
                    <div class="text-center">
                        <h3 class="mt-2">{{ __('Reset Password') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('forgotpassword') }}">
                        @csrf

                        <div class="row">
                            <label for="email" class="offset-md-2 col-md-8 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="offset-md-2 col-md-8 form-group has-icon">
                                <i class="icon-envelope-o"></i>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection