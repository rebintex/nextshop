<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/coupons.fields.status').':') !!}
    <p>{{ $coupon->status }}</p>
</div>

<!-- Discount Field -->
<div class="col-sm-12">
    {!! Form::label('discount', __('models/coupons.fields.discount').':') !!}
    <p>{{ $coupon->discount }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/coupons.fields.created_at').':') !!}
    <p>{{ $coupon->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/coupons.fields.updated_at').':') !!}
    <p>{{ $coupon->updated_at }}</p>
</div>

