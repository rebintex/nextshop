<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/tags.fields.name').':') !!}
    <p>{{ $tag->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/tags.fields.created_at').':') !!}
    <p>{{ $tag->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/tags.fields.updated_at').':') !!}
    <p>{{ $tag->updated_at }}</p>
</div>

