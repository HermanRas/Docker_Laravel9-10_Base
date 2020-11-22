@extends('layouts.app')

@section('content')
    <section>

        <div class="row justify-content-center p-3 mt-2">
            <div class="col-6">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title">Account Logout</h5>
                        </div>
                        <div class="card-body">

                            @if (session('status'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <p>You have been logged out !</p>

                            <a href="{{ route('home') }}" class="form-control btn btn-primary">Dashboard</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
