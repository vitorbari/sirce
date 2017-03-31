@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h1>Oops!</h1>

                <h2>404 Not Found</h2>

                <div>
                    Sorry, an error has occured, Requested page not found!
                </div>

                <div style="margin-top:20px;">
                    <a href="{{ route('pages.home') }}" class="btn btn-primary">
                        Take Me Home
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
