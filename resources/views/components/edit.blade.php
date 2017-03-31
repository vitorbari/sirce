@extends('layouts.app')

@section('content')


    @include('layouts.partials.errors')

    @if(isset($component))
        {!! Form::model($component, ['method' => 'PATCH', 'route' => [$form_route, $component->id], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @else
        {!! Form::open(['route' => [$form_route], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @endif

        <fieldset>

            <legend>Component</legend>

            <div class="form-group">
                <label for="component" class="col-lg-2 control-label">Component Name</label>
                <div class="col-lg-10">
                    {!! Form::text('component', NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="picture" class="col-lg-2 control-label">Picture</label>
                <div class="col-lg-10">
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="component_category_id" class="col-lg-2 control-label">Category</label>
                <div class="col-lg-10">
                    {!! Form::select('component_category_id', $categories, NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="manufacturer_id" class="col-lg-2 control-label">Manufacturer</label>
                <div class="col-lg-10">
                    {!! Form::select('manufacturer_id', $manufacturers, NULL, ['class' => 'form-control']) !!}
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
