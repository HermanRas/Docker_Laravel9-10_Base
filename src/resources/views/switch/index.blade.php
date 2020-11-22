@extends('layouts.app')

@section('content')
    <section>

        <div class="row pt-3 mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title">Switches</h5>
                    </div>
                    <div class="card-body" style="min-height: 60vh">

                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Welcome to the switches page !</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection