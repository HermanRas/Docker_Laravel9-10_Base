@extends('layouts.app')

@section('content')
    <section>

        <div class="row justify-content-center p-3 mt-2">
            <div class="col-6">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title">Account Login</h5>
                        </div>
                        <div class="card-body">

                            @if (session('status'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @error('email')
                                <div class="alert alert-danger p-0 m-0" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">User Email-address</span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Your email address" value="{{ old('email') }}">
                            </div>

                            @error('password')
                                <div class="alert alert-danger p-0 m-0" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">User Password </span>
                                </div>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="A nice strong password" value="{{ old('password') }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="link link-primary" href="{{ route('register') }}">forgot password?</a>
                                </div>
                            </div>
                            <button type="submit" class="form-control btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
