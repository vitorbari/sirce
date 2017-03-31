@extends('layouts.app')

@section('content')


    <div class="page-header">
        <h1>{{ $user->name }}</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            All sketches created by the user

            <span class="badge pull-right">{{ $references_total }}</span>
        </div>

        @if($references->count() == 0)
            <div class="panel-body text-center">
                @if($my_profile)
                    You have not created any sketches yet.
                    <h3><a href="{{ route('sketches.create') }}">Click here</a> to create one.</h3>
                @else
                    The user has not created any sketches yet.
                @endif
            </div>
        @else
            @include('profiles.partials.references_table', ['references' => $references])
        @endif
    </div>

@endsection
