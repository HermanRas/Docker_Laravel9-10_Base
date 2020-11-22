@extends('layouts.app')

@section('content')
    <section>

        <div class="row pt-3 mt-2">
            <div class="col-12">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title">Dashboard</h5>
                        </div>
                        <div class="card-body" style="min-height: 60vh">
                            Hello World
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
