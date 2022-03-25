<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/addresses.fields.name').':') !!}
    <p>{{ $address->name }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/addresses.fields.user_id').':') !!}
    <p>{{ $address->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/addresses.fields.created_at').':') !!}
    <p>{{ $address->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/addresses.fields.updated_at').':') !!}
    <p>{{ $address->updated_at }}</p>
</div>

