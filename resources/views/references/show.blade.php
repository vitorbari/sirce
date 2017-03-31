@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>{{ $reference->title }}</h1>
    </div>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">Instructions</div>
                <div class="panel-body reference-markdown">
                    {!! $parsed_markdown !!}
                </div>
            </div>

            @if(count($files))

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Files
                        <a class="btn btn-xs btn-primary pull-right" href="{{ route('sketches.files', $reference->id) }}">
                            Download All
                            &nbsp;<span class="label label-info">{{ count($files) }}</span>
                        </a>
                    </div>
                    <div class="panel-body">

                        @foreach($files as $file)
                            <li>
                                <a href="{{ route('sketches.file', [$reference->id, $file]) }}">{{ $file }}</a>
                            </li>
                        @endforeach

                    </div>
                </div>

            @endif

        </div>
        <div class="col-md-3">

            @if($user_starred)
                <a class="btn btn-default btn-block" href="{{ route('sketches.unstar', $reference) }}">Unstar</a>
            @else
                <a class="btn btn-primary btn-block" href="{{ route('sketches.star', $reference) }}">Star</a>
            @endif

            @if($is_creator)
                <a class="btn btn-default btn-block" href="{{ route('sketches.edit', $reference) }}">Edit</a>
                @if(! $reference->published_at)
                    <a class="btn btn-success btn-block" href="{{ route('sketches.publish', $reference) }}">Publish</a>
                @endif
            @endif

            <br/>

            <div class="panel panel-default">
                <div class="panel-heading">Details</div>
                <div class="panel-body">

                    <dl>
                        <dt>Created by:</dt>
                        <dd><a href="{{ route('profiles.index', $reference->user->id) }}">{{ $reference->user->name }}</a></dd>

                        @if($reference->published_at)
                            <dt>Published at:</dt>
                            <dd>{{ $reference->published_at->diffForHumans() }}</dd>
                        @endif

                        <dt>Language:</dt>
                        <dd>{{ $reference->language->language }}</dd>

                        <dt>Views:</dt>
                        <dd>{{ $reference->views }}</dd>

                        <dt>Stars:</dt>
                        <dd>{{ $reference->favorites->count() }}</dd>

                        <dt>Component:</dt>
                        <dd>
                            <small>
                                @foreach($component_category_hierarchy as $category)
                                    {{ $category }} /
                                @endforeach
                            </small>
                            <a href="{{ route('components.show', $reference->component_id) }}">
                                {{ $reference->component->component }}
                            </a>
                        </dd>

                    </dl>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Boards</div>
                <div class="panel-body">

                    <p class="small">This sketch is compatibility with:</p>

                    @foreach($reference->boards as $board)
                        <li>{!! link_to_route('boards.show', $board->board, $board->id) !!}</li>
                    @endforeach

                </div>
            </div>

        </div>
    </div>



@endsection
