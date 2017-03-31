@extends('layouts.app')

@section('content')

    @foreach($manufacturers->chunk(4) as $chunked_manufacturers)

        <div class="row">
            @foreach ($chunked_manufacturers as $manufacturer)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <a href="{{ route('manufacturers.show', $manufacturer->id) }}" class="">
                            @if($manufacturer->picture)
                                <img src="{{ $manufacturer->picture }}" alt="{{ $manufacturer->manufacturer }}">
                            @endif

                            <div class="caption">

                                <h3>
                                    <small>{{ $manufacturer->manufacturer->manufacturer }}</small>
                                    <br/>
                                    {{ $manufacturer->manufacturer }}
                                </h3>
                                {{--<p>...</p>--}}
                                {{--<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>--}}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach

    {!! $manufacturers->render(); !!}

@endsection
