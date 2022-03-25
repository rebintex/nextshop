<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/coupons.fields.status').':') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount', __('models/coupons.fields.discount').':') !!}
    {!! Form::number('discount', null, ['class' => 'form-control']) !!}
</div>