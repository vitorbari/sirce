@extends('layouts.app')

@section('content')


    @include('layouts.partials.errors')

    @if(isset($manufacturer))
        {!! Form::model($manufacturer, ['method' => 'PATCH', 'route' => [$form_route, $manufacturer->id], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @else
        {!! Form::open(['route' => [$form_route], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @endif

        <fieldset>

            <legend>Manufacturer</legend>

            <div class="form-group">
                <label for="manufacturer" class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    {!! Form::text('manufacturer', NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="picture" class="col-lg-2 control-label">Picture</label>
                <div class="col-lg-10">
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                    {!! Form::textarea('description', NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="website" class="col-lg-2 control-label">Link</label>
                <div class="col-lg-10">
                    {!! Form::text('website', NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </fieldset>


    {!! Form::close() !!}



@endsection
