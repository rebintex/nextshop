<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/posts.fields.name').':') !!}
    <p>{{ $post->name }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', __('models/posts.fields.content').':') !!}
    <p>{{ $post->content }}</p>
</div>

<!-- Views Field -->
<div class="col-sm-12">
    {!! Form::label('views', __('models/posts.fields.views').':') !!}
    <p>{{ $post->views }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/posts.fields.user_id').':') !!}
    <p>{{ $post->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/posts.fields.created_at').':') !!}
    <p>{{ $post->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/posts.fields.updated_at').':') !!}
    <p>{{ $post->updated_at }}</p>
</div>

