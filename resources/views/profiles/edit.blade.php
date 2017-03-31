@extends('layouts.app')

@section('title', 'Edit my profile')

@section('content')

    <div class="well">

        {!! Form::model($user, ['method' => 'PATCH', 'route' => 'profiles.update', 'class' => 'form-horizontal']) !!}

        <fieldset>
            <legend>Edit My Profile</legend>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Name</label>

                <div class="col-lg-10">
                    {!! Form::text('name', NULL, ['class' => 'form-control', 'maxlength' => 255]) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-lg-2 control-label">Location</label>

                <div class="col-lg-10">
                    {!! Form::text('location', NULL, ['class' => 'form-control', 'maxlength' => 255]) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="about" class="col-lg-2 control-label">About</label>

                <div class="col-lg-10">
                    {!! Form::textarea('about', NULL, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Newsletter</label>

                <div class="col-lg-10">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('newsletter', 1, NULL) !!} I wish to receive emails from Sirce.info
                        </label>
                    </div>
                    <span class="help-block small">We won't bother you more than once a month.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </fieldset>
        </form>

    </div>

@endsection
