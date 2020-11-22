@extends('layouts.app')

@section('content')
    <section>

        <div class="row justify-content-center p-3 mt-2">
            <div class="col-6">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title">Account Registration</h5>
                        </div>
                        <div class="card-body">

                            @error('name')
                                <div class="alert alert-danger p-0 m-0" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Your Name</span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your name"
                                    value="{{ old('name') }}">
                            </div>

                            @error('username')
                                <div class="alert alert-danger p-0 m-0" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">User Name</span>
                                </div>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Your login user name" value="{{ old('username') }}">
                            </div>

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

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Confirm Password </span>
                                </div>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your password"
                                    value="{{ old('password_confirmation') }}">
                            </div>

                            <button type="submit" class="form-control btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
