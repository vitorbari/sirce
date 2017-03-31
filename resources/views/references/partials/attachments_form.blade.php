<div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
    {!! Form::label('attachments[]', 'Attachments:', ['class' => 'control-label']) !!}
    {!! Form::file('attachments[]', ['class' => 'form-control', 'multiple']) !!}
</div>

