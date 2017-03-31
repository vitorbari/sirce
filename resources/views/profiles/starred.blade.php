@extends('layouts.app')

@section('content')


    <div class="page-header">
        <h1>Starred Sketches</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            All sketches starred by you

            <span class="badge pull-right">{{ $references_total }}</span>
        </div>

        @if($references->count() == 0)
            <div class="panel-body text-center">
                You have not starred any sketches yet.
            </div>
        @else
            @include('profiles.partials.references_table', ['references' => $references])
        @endif
    </div>

@endsection
