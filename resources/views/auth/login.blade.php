@extends('auth.master')


@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="p-4">
            <div class="auth-logo text-center mb-4">
                <!-- <h3>{{ config('app.name') }}</h3> -->
                
                <img style="width: 20%; height:auto;" src="{{ asset('packages/images/logo.png') }}">
            </div>
            <h1 class="mb-3 text-18">Login</h1>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="text" class="form-control  form-control-rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-rounded btn-primary btn-block mt-2">Login</button>

                <br>
            </form>
        </div>
    </div>
</div>
@endsection
