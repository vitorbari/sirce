@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-3">

            <div class="list-group">
                @foreach($categories_list as $key => $category)
                    <a href="{{ route('components.index', ['component_category_id' => $key]) }}" class="list-group-item small {{ $key == 1 ? 'disabled' : '' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>

        </div>
        <div class="col-md-9">


            @foreach($components->chunk(4) as $chunked_components)

                <div class="row">
                    @foreach ($chunked_components as $component)
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <a href="{{ route('components.show', $component->id) }}" class="">
                                    <img src="{{ $component->picture }}" alt="{{ $component->component }}">

                                    <div class="caption">

                                        <h3>
                                            @if($component->category)
                                                <small>{{ $component->category->category }}</small>
                                                <br/>
                                            @endif
                                            @if($component->manufacturer)
                                                <small>{{ $component->manufacturer->manufacturer }}</small>
                                                <br/>
                                            @endif
                                            {{ $component->component }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endforeach

            {!! $components->appends(Request::only($fields))->render(); !!}

        </div>
    </div>

@endsection
