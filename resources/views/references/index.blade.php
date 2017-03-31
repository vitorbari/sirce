@extends('layouts.app')

@section('content')

    <div class="well well-sm">

        {!! Form::open(['method' => 'get']) !!}

        <div class="row">
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="board">Title</label>
                            {!! Form::input('text', 'title', Request::input('title'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {{--<div class="form-group">--}}
                            {{--<label for="board">Author</label>--}}
                            {{--{!! Form::input('text', 'author', Request::input('author'), ['class' => 'form-control']) !!}--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" class="btn btn-default" style="margin-top: 25px;">Filter</button>
            </div>
        </div>


        {!! Form::close() !!}

    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="hidden-xs hidden-sm">ID</th>
                <th>Title</th>
                <th class="hidden-xs">Component</th>
                <th class="hidden-xs">Boards</th>
                <th class="hidden-xs hidden-sm">Author</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($references as $reference)
                <tr>
                    <td class="hidden-xs hidden-sm">
                        <a href="{{ route('sketches.show', $reference->id) }}">
                            #{{ $reference->id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('sketches.show', $reference->id) }}">
                            {{ $reference->title }}
                        </a>
                    </td>
                    <td class="hidden-xs">
                        <a href="{{ route('components.show', $reference->component_id) }}">
                            {{ $reference->component->component }}
                        </a>
                    </td>
                    <td class="hidden-xs">
                        <ul class="list-unstyled">
                            @foreach($reference->boards as $board)
                                <li>
                                    <a href="{{ route('boards.show', $board->id) }}">
                                        {{ $board->board }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="hidden-xs hidden-sm">
                        <a href="{{ route('profiles.index', $reference->user_id) }}">
                            {{ $reference->user->name }}
                        </a>
                    </td>
                    <td>{{ $reference->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $references->appends(Request::only($fields))->render(); !!}

@endsection
