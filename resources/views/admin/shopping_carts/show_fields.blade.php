<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', __('models/shoppingCarts.fields.quantity').':') !!}
    <p>{{ $shoppingCart->quantity }}</p>
</div>

<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', __('models/shoppingCarts.fields.product_id').':') !!}
    <p>{{ $shoppingCart->product_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/shoppingCarts.fields.user_id').':') !!}
    <p>{{ $shoppingCart->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/shoppingCarts.fields.created_at').':') !!}
    <p>{{ $shoppingCart->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/shoppingCarts.fields.updated_at').':') !!}
    <p>{{ $shoppingCart->updated_at }}</p>
</div>

