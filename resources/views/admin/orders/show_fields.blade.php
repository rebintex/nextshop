<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/orders.fields.status').':') !!}
    <p>{{ $order->status }}</p>
</div>

<!-- Address Id Field -->
<div class="col-sm-12">
    {!! Form::label('address_id', __('models/orders.fields.address_id').':') !!}
    <p>{{ $order->address_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/orders.fields.user_id').':') !!}
    <p>{{ $order->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/orders.fields.created_at').':') !!}
    <p>{{ $order->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/orders.fields.updated_at').':') !!}
    <p>{{ $order->updated_at }}</p>
</div>

