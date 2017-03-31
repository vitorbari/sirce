@extends('layouts.home')

@section('styles')
    {{--<link rel="stylesheet" href="{{ asset("js/vendor/vegas/vegas.min.css") }}">--}}

    <style>
        body {
            padding-top: 60px;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset("js/vendor/handlebars.js") }}"></script>
    <script src="{{ asset("js/vendor/typeahead.bundle.js?v=20160304") }}"></script>
{{--    <script src="{{ asset("js/vendor/vegas/vegas.min.js") }}"></script>--}}
    <script src="{{ asset("js/home.js?v=20160304") }}"></script>
@endsection

@section('jumbotron-content')

    <div class="row">

        <div class="col-lg-12">

            <span class="typeahead-loading">Loading...</span>

            <div class="clearfix">
                <input type="text" id="home-typeahead" class="form-control input-lg" autofocus placeholder="Search for components / boards / mcus...">
            </div>

            <span id="helpBlock" class="help-block hidden-xs">
                We hope you find a sketch that helps you get your project done. <br>
                While you are here, why don't you <a href="{{ route('sketches.create') }}">create a sketch</a> and share knowledge with others.
            </span>

        </div>
        <!-- /.col-lg-6 -->

    </div><!-- /.row -->

@endsection

@section('content')

    @include('home.partials.stats')

    <hr/>

    @include('home.partials.panels')

    @include('home.partials.typeahead')

@endsection
