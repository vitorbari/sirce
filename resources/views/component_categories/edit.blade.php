@extends('layouts.app')

@section('content')


    @include('layouts.partials.errors')

    @if(isset($component_category))
        {!! Form::model($component_category, ['method' => 'PATCH', 'route' => [$form_route, $component_category->id], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @else
        {!! Form::open(['route' => [$form_route], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
    @endif

        <fieldset>

            <legend>Category</legend>

            <div class="form-group">
                <label for="category" class="col-lg-2 control-label">Category Name</label>
                <div class="col-lg-10">
                    {!! Form::text('category', NULL, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="parent_id" class="col-lg-2 control-label">Parent</label>
                <div class="col-lg-10">
                    {!! Form::select('parent_id', $categories, NULL, ['class' => 'form-control']) !!}
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
