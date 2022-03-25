<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/comments.fields.title').':') !!}
    <p>{{ $comment->title }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', __('models/comments.fields.content').':') !!}
    <p>{{ $comment->content }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/comments.fields.user_id').':') !!}
    <p>{{ $comment->user_id }}</p>
</div>

<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', __('models/comments.fields.product_id').':') !!}
    <p>{{ $comment->product_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/comments.fields.created_at').':') !!}
    <p>{{ $comment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/comments.fields.updated_at').':') !!}
    <p>{{ $comment->updated_at }}</p>
</div>

