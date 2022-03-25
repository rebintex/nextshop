<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', __('models/favourites.fields.product_id').':') !!}
    <p>{{ $favourite->product_id }}</p>
</div>

<!-- Users Id Field -->
<div class="col-sm-12">
    {!! Form::label('users_id', __('models/favourites.fields.users_id').':') !!}
    <p>{{ $favourite->users_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/favourites.fields.created_at').':') !!}
    <p>{{ $favourite->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/favourites.fields.updated_at').':') !!}
    <p>{{ $favourite->updated_at }}</p>
</div>

