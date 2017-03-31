@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="text-right">
                        @if($my_profile)
                            <a href="{{ route('profiles.edit') }}">Edit my profile</a>
                        @endif
                    </div>

                    @if($user->avatar)
                        <div class="text-center">
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                 class="img-responsive center-block img-thumbnail">
                        </div>
                    @endif

                    <h2>{{ $user->name }}</h2>

                    <li>Member Since: {{ $user->created_at->toFormattedDateString() }}</li>

                    <li>
                        Location:
                        @if($user->location)
                            {{ $user->location }}
                        @else
                            <span class="label label-default">Not filled</span>
                        @endif
                    </li>

                    <li>
                        About:
                        @if($user->about)
                            {{ $user->about }}
                        @else
                            <span class="label label-default">Not filled</span>
                        @endif
                    </li>

                    <br/>

                    <small class="text-muted">Sketches created by {{ $user->name }}:</small>

                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <h4 class="">{{ $references_total }}</h4>
                            <small>Total</small>
                        </div>

                        <div class="col-xs-4 text-center">
                            <h4 class="">{{ $page_views }}</h4>
                            <small>Page Views</small>
                        </div>

                        <div class="col-xs-4 text-center">
                            <h4 class="">{{ $favorited }}</h4>
                            <small>Starred</small>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Lasts sketches created by {{ $user->name }}

                    @if($references->count())
                        <a href="{{ route('profiles.sketches', $user->id) }}"
                           class="btn btn-primary btn-xs pull-right">
                            See all: {{ $references_total }}
                        </a>
                    @endif
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

        </div>
    </div>


    {{-- $board --}}

@endsection
