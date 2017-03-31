
<div class="form-group {{ $errors->has('markdown') ? 'has-error' : '' }}">

    {!! Form::label('', 'Instructions:', ['class' => 'control-label']) !!}

    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        In this field, you should put every information that will help people to use this sketch.
        <br>
        To format it, you may use <b>Markdown</b>
        (<a href="https://help.github.com/articles/markdown-basics/" class="alert-link" target="_blank">click here to learn about</a>).
        <br>
        If a <b>readme.md</b> file is sent, it will be used instead of the content of this field.
        <br>
        Try using the <a href="#" class="alert-link load-template">instructions template</a> to get started.
    </div>

    {!! Form::textarea('markdown', NULL, ['class' => 'form-control', 'rows' => 20]) !!}

    <div class="text-right">
        <button type="button" class="btn btn-primary btn-xs load-template">
            Load template
        </button>
        <button type="button" class="btn btn-primary btn-xs" id="live-preview">
            Live preview
        </button>
    </div>

    <span class="help-block"></span>
</div>

<textarea class="hide" id="markdown-template">@include('references.partials.markdown_template')</textarea>

<!-- Modal -->
<div class="modal fade" id="modal-reference-edit" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-label"></h4>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>