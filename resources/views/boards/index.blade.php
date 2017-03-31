@extends('layouts.app')

@section('content')

    <div class="well well-sm">

        {!! Form::open(['method' => 'get']) !!}

        <div class="row">
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="board">Board</label>
                            {!! Form::input('text', 'board', Request::input('board'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="board_family_id">Family</label>
                            {!! Form::select('board_family_id', $board_families, Request::input('board_family_id'),
                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="manufacturer_id">Manufacturer</label>
                            {!! Form::select('manufacturer_id', $manufacturers, Request::input('manufacturer_id'),
                            ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" class="btn btn-default" style="margin-top: 25px;">Filter</button>
            </div>
        </div>


        {!! Form::close() !!}

    </div>


    @foreach($boards->chunk(4) as $chunked_boards)

        <div class="row">
            @foreach ($chunked_boards as $board)
                <div class="col-sm-3">
                    <div class="thumbnail">
                        <a href="{{ route('boards.show', $board->id) }}" class="">
                            <img src="{{ $board->picture }}" alt="{{ $board->board }}">

                            <div class="caption">

                                <h3>
                                    <small>{{ $board->manufacturer->manufacturer }}</small>
                                    <br/>
                                    {{ $board->board }}
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach

    {!! $boards->appends(Request::only($fields))->render(); !!}

@endsection
