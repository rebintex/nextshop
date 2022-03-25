<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/posts.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('models/posts.fields.content').':') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/posts.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>