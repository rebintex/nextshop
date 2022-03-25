<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/orderProducts.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', __('models/orderProducts.fields.quantity').':') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', __('models/orderProducts.fields.order_id').':') !!}
    {!! Form::text('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('models/orderProducts.fields.product_id').':') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>