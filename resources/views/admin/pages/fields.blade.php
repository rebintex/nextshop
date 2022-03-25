<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/pages.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 30]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('models/pages.fields.content').':') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control','minlength' => 25]) !!}
</div>