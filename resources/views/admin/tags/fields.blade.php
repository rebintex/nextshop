<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/tags.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>