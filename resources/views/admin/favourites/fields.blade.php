<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('models/favourites.fields.product_id').':') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('users_id', __('models/favourites.fields.users_id').':') !!}
    {!! Form::text('users_id', null, ['class' => 'form-control']) !!}
</div>