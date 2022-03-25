<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/addresses.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/addresses.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>