<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/comments.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 30]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', __('models/comments.fields.content').':') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control','minlength' => 25]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/comments.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('models/comments.fields.product_id').':') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>