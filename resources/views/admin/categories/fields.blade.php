<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 200]) !!}
</div>