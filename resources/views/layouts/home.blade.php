@extends('layouts.partials.template')

@section('content-wrapper')

    <div class="jumbotron">
        <div class="container">
            @include('flash::message')

            @yield('jumbotron-content')
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

@endsection
