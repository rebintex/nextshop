<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/features.fields.name').':') !!}
    <p>{{ $features->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/features.fields.created_at').':') !!}
    <p>{{ $features->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/features.fields.updated_at').':') !!}
    <p>{{ $features->updated_at }}</p>
</div>

