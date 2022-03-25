<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/brands.fields.name').':') !!}
    <p>{{ $brand->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/brands.fields.created_at').':') !!}
    <p>{{ $brand->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/brands.fields.updated_at').':') !!}
    <p>{{ $brand->updated_at }}</p>
</div>

