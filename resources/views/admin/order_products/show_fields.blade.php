<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/orderProducts.fields.name').':') !!}
    <p>{{ $orderProduct->name }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', __('models/orderProducts.fields.quantity').':') !!}
    <p>{{ $orderProduct->quantity }}</p>
</div>

<!-- Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('order_id', __('models/orderProducts.fields.order_id').':') !!}
    <p>{{ $orderProduct->order_id }}</p>
</div>

<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', __('models/orderProducts.fields.product_id').':') !!}
    <p>{{ $orderProduct->product_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/orderProducts.fields.created_at').':') !!}
    <p>{{ $orderProduct->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/orderProducts.fields.updated_at').':') !!}
    <p>{{ $orderProduct->updated_at }}</p>
</div>

