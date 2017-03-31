@extends('layouts.app')

@section('scripts')
    <script src="{{ asset("js/references-edit.js") }}"></script>

    <script>
        var component_id = {{ old('component_id', (isset($reference) ? $reference->component_id : 0)) }};
    </script>

@endsection

@section('content')

    @include('layouts.partials.errors')

    @if(isset($reference))
        {!! Form::model($reference, ['method' => 'PATCH', 'route' => [$form_route, $reference->id], 'files' => TRUE]) !!}
    @else
        {!! Form::open(['route' => [$form_route], 'files' => TRUE]) !!}
    @endif

    <div class="well well-sm text-right">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title', 'Title of the sketch:', ['class' => 'control-label']) !!}
                {!! Form::text('title', NULL, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'How to blink a led with an Arduino']) !!}
                {{--<span class="help-block small">--}}
                    {{--Make it very descriptive about what this sketch is going to teach.--}}
                {{--</span>--}}
            </div>


            <div class="form-group {{ $errors->has('component_id') ? 'has-error' : '' }}">
                {!! Form::label('', 'Component:', ['class' => 'control-label']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('component_category_id', 'Category', ['class' => 'text-muted small']) !!}
                        {!! Form::select('component_category_id', $categories, (isset($reference) ? $reference->component->component_category_id : NULL), ['class' =>
                                'form-control']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('component_id', 'Choose Component', ['class' => 'text-muted small']) !!}
                        {!! Form::select('component_id', [], NULL, ['class' =>
                                'form-control']) !!}
                    </div>
                </div>

            </div>


            @include('references.partials.markdown_form')

        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('language_id') ? 'has-error' : '' }}">
                {!! Form::label('language_id', 'Programming language of source code:', ['class' => 'control-label']) !!}
                {!! Form::select('language_id', ['' => 'Please select...'] + $languages, NULL, ['class' =>
                'form-control']) !!}
            </div>

            <div class="checkbox">
                <label>
                    {!! Form::checkbox('draft', 1, isset($reference) && empty($reference->published_at)) !!}
                    Save as draft
                </label>
            </div>

            @if(isset($reference) && $reference->published_at)
                <div class="alert alert-success small">
                    Published: {{ $reference->published_at }}
                </div>
            @endif

            <hr>

            @include('references.partials.attachments_form')

            <hr>

            @include('references.partials.boards_form')


        </div>
    </div>

    <div class="well well-sm text-right">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    {!! Form::close() !!}

@endsection
