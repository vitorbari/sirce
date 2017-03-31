@extends('layouts.app')

@section('content')

    <div class="well well-sm">

        {!! Form::open(['method' => 'get']) !!}

        <div class="row">
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="mcu">MCU</label>
                            {!! Form::input('text', 'mcu', Request::input('mcu'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="mcu_family_id">Family</label>
                            {!! Form::select('mcu_family_id', $mcu_families, Request::input('mcu_family_id'),
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


    @foreach($mcus->chunk(4) as $chunked_mcus)

        <div class="row">
            @foreach ($chunked_mcus as $mcu)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <a href="{{ route('mcus.show', $mcu->id) }}" class="">
                            <img src="{{ $mcu->picture }}" alt="{{ $mcu->mcu }}">

                            <div class="caption">

                                <h3>
                                    <small>{{ $mcu->manufacturer->manufacturer }}</small>
                                    <br/>
                                    {{ $mcu->mcu }}
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach

    {!! $mcus->appends(Request::only($fields))->render(); !!}

@endsection
