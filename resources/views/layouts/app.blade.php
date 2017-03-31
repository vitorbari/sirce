@extends('layouts.partials.template')

@section('content-wrapper')

    <div class="container">
        @include('flash::message')

        @yield('content')
    </div>

@endsection
